<?php

declare(strict_types=1);

namespace App\Http\Payloads;

final readonly class RequireJson
{
    public function __construct(
        public string $package,
        public string $version,
    ) {
    }

    public static function fromArray(array $data): RequireJson
    {
        return new RequireJson(
            package: $data['package'],
            version: $data['version'],
        );
    }
}
