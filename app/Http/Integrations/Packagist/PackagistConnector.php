<?php

declare(strict_types=1);

namespace App\Http\Integrations\Packagist;

use Saloon\Http\Connector;
use Saloon\Traits\Plugins\AcceptsJson;

final class PackagistConnector extends Connector
{
    use AcceptsJson;

    public function __construct(
        private readonly string $url,
    ) {
    }

    public static function public(): PackagistConnector
    {
        return new PackagistConnector(
            url: 'https://repo.packagist.org',
        );
    }

    public static function stats(): PackagistConnector
    {
        return new PackagistConnector(
            url: 'https://packagist.org',
        );
    }

    public function resolveBaseUrl(): string
    {
        return $this->url;
    }

    protected function defaultHeaders(): array
    {
        return [
            'UserAgent' => 'DependencyMap_Laravel_v1'
        ];
    }
}
