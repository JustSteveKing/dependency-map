<?php

declare(strict_types=1);

namespace App\Services;

use App\DTOs\AdvisoryObject;
use App\DTOs\PackageObject;
use App\Http\Payloads\ComposerJson;
use App\Models\Advisory;
use App\Models\Application;
use App\Models\Maintainer;
use App\Models\Package;
use App\Models\Project;
use App\Models\Vendor;
use Illuminate\Database\DatabaseManager;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

final readonly class IngressService
{
    public function __construct(
        private DatabaseManager $database,
    ) {
    }

    public function getProjectFromId(string $project): Project|Model
    {
        return Project::query()->findOrFail(
            id: $project,
        );
    }

    public function ensureApplication(string $project, ComposerJson $payload): Application|Model
    {
        return $this->database->transaction(
            callback: fn () => Application::query()->updateOrCreate(
                attributes: [
                    'name' => $payload->name,
                    'project_id' => $project,
                ],
                values: [
                    'composer' => $payload->toArray(),
                ],
            ),
            attempts: 3,
        );
    }

    public function ensureVendor(string $name): Vendor|Model
    {
        return $this->database->transaction(
            callback: fn () => Vendor::query()->firstOrCreate(
                attributes: [
                    'name' => $name,
                    'key' => Str::of($name)->lower()->slug()->toString(),
                ],
            ),
            attempts: 3,
        );
    }

    public function ensurePackage(PackageObject $payload, string $repo, string $vendor): Package|Model
    {
        return $this->database->transaction(
            callback: fn () => Package::query()->updateOrCreate(
                attributes: [
                    'name' => $repo,
                    'key' => Str::of($repo)->lower()->slug()->toString(),
                    'vendor_id' => $vendor,
                ],
                values: $payload->toArray(),
            ),
            attempts: 3,
        );
    }

    public function ensureAdvisory(string $package, AdvisoryObject $advisory): Advisory|Model
    {
        return $this->database->transaction(
            callback: fn () => Advisory::query()->updateOrCreate(
                attributes: [
                    'identifier' => $advisory->identifier,
                    'package_id' => $package,
                ],
                values: $advisory->toArray(),
            ),
            attempts: 3,
        );
    }

    public function ensureMaintainer(array $maintainer): Maintainer|Model
    {
        return $this->database->transaction(
            callback: fn () => Maintainer::query()->updateOrCreate(
                attributes: [
                    'name' => $maintainer['name'],
                ],
                values: [
                    'email' => $maintainer['email'] ?? null,
                    'url' => $maintainer['homepage'] ?? null,
                ],
            ),
        );
    }

    public function ignoredPackages(): array
    {
        return [
            'php',
            'ext-json',
            'ext-ctype',
            'ext-filter',
            'ext-hash',
            'ext-mbstring',
            'ext-openssl',
            'ext-session',
            'ext-tokenizer',
            'composer-runtime-api',
        ];
    }
}
