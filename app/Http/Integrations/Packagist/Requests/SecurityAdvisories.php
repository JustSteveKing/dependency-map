<?php

declare(strict_types=1);

namespace App\Http\Integrations\Packagist\Requests;

use Saloon\Enums\Method;
use Saloon\Http\Request;

final class SecurityAdvisories extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        private readonly string $vendor,
        private readonly string $package,
        private readonly string $timestamp,
    ) {}

    public function resolveEndpoint(): string
    {
        return "https://packagist.org/api/security-advisories/?updatedSince=[{$this->timestamp}]&packages[]=[{$this->vendor}/{$this->package}]";
    }
}
