<?php

declare(strict_types=1);

namespace App\Http\Integrations\Packagist;

use Saloon\Http\Connector;
use Saloon\Traits\Plugins\AcceptsJson;

final class PackagistConnector extends Connector
{
    use AcceptsJson;

    public function resolveBaseUrl(): string
    {
        return 'https://repo.packagist.org';
    }

    protected function defaultHeaders(): array
    {
        return [
            'UserAgent' => 'DependencyMap_Laravel_v1'
        ];
    }
}
