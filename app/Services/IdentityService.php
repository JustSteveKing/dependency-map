<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\User;
use Illuminate\Auth\AuthManager;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\DatabaseManager;
use Laravel\Socialite\Contracts\User as OAuthUser;
use Laravel\Socialite\Two\User as AbstractUser;
use Throwable;

final readonly class IdentityService
{
    /**
     * @param DatabaseManager $database
     */
    public function __construct(
        private DatabaseManager $database,
        private AuthManager $auth,
    ) {}

    /**
     * @param OAuthUser|AbstractUser $user
     * @return User
     * @throws Throwable
     */
    public function updateOrCreate(OAuthUser|AbstractUser $user): User
    {
        return $this->database->transaction(
            callback: fn () => User::query()->updateOrCreate(
                attributes: [
                    'email' => $user->getEmail(),
                    'provider_id' => $user->getId(),
                ],
                values: [
                    'name' => $user->getName(),
                    'nickname' => $user->getNickname(),
                    'avatar' => $user->getAvatar(),
                    'access_token' => $user->token,
                    'refresh_token' => $user->refreshToken,
                ],
            ),
            attempts: 3,
        );
    }

    public function login(User $user): bool|Authenticatable
    {
        return $this->auth->loginUsingId(
            id: $user->getKey(),
        );
    }
}
