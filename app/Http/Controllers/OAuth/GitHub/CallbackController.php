<?php

declare(strict_types=1);

namespace App\Http\Controllers\OAuth\GitHub;

use App\Services\IdentityService;
use Illuminate\Config\Repository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Laravel\Socialite\SocialiteManager;
use Laravel\Socialite\Two\GithubProvider;

final readonly class CallbackController
{
    public function __construct(
        private Repository $config,
        private SocialiteManager $manager,
        private IdentityService $service,
    ) {}

    public function __invoke(Request $request): RedirectResponse
    {
        $user = $this->service->updateOrCreate(
            user: $this->manager->buildProvider(
                provider: GithubProvider::class,
                config: $this->config->get('services.github'),
            )->stateless()->user(),
        );

        $this->service->login(
            user: $user,
        );

        return new RedirectResponse(
            url: route('pages:index'),
        );
    }
}
