<?php

declare(strict_types=1);

namespace App\Http\Integrations\Packagist\Requests;

use Saloon\Enums\Method;
use Saloon\Http\Request;

final class PackageStatistics extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        private readonly string $vendor,
        private readonly string $package,
    ) {}

    public function resolveEndpoint(): string
    {
        return "/packages/{$this->vendor}/{$this->package}/stats.json";
    }
}
