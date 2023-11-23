<?php

declare(strict_types=1);

namespace App\Services;

use App\DTOs\PackageObject;
use App\Http\Payloads\ComposerJson;
use App\Models\Application;
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

    public function ignoredPackages(): array
    {
        return [
            'php',
            'ext-',
        ];
    }
}
