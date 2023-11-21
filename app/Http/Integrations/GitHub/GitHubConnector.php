<?php

declare(strict_types=1);

namespace App\Http\Integrations\GitHub;

use Saloon\Contracts\Authenticator;
use Saloon\Http\Auth\TokenAuthenticator;
use Saloon\Http\Connector;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\Contracts\HasPagination;
use Saloon\PaginationPlugin\PagedPaginator;
use Saloon\PaginationPlugin\Paginator;
use Saloon\Traits\Plugins\AcceptsJson;

final class GitHubConnector extends Connector implements HasPagination
{
    use AcceptsJson;

    public function __construct(
        private readonly string $token,
    ) {}

    public function resolveBaseUrl(): string
    {
        return 'https://api.github.com';
    }

    protected function defaultAuth(): Authenticator
    {
        return new TokenAuthenticator(
            token: $this->token,
        );
    }

    protected function defaultHeaders(): array
    {
        return [
            'Accept' => 'application/vnd.github+json'
        ];
    }

    public function paginate(Request $request): PagedPaginator
    {
        return new class(connector: $this, request: $request) extends PagedPaginator
        {
            //
            protected function isLastPage(Response $response): bool
            {
                return is_null($response->json('next_page_url'));
            }

            protected function getPageItems(Response $response, Request $request): array
            {
                return $response->json();
            }
        };
    }
}
