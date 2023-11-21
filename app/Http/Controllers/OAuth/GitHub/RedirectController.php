<?php

declare(strict_types=1);

namespace App\Http\Controllers\OAuth\GitHub;

use Illuminate\Config\Repository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Laravel\Socialite\SocialiteManager;
use Laravel\Socialite\Two\GithubProvider;

final readonly class RedirectController
{
    public function __construct(
        private Repository $config,
        private SocialiteManager $manager,
    ) {}

    public function __invoke(Request $request): RedirectResponse
    {
        return $this->manager->buildProvider(
            provider: GithubProvider::class,
            config: $this->config->get('services.github'),
        )->stateless()->redirect();
    }
}
