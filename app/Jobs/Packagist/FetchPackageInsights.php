<?php

declare(strict_types=1);

namespace App\Jobs\Packagist;

use App\DTOs\PackageObject;
use App\Http\Integrations\Packagist\PackagistConnector;
use App\Http\Integrations\Packagist\Requests\PackageDetails;
use App\Http\Integrations\Packagist\Requests\PackageStatistics;
use App\Http\Integrations\Packagist\Requests\SecurityAdvisories;
use App\Services\IngressService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Bus\Dispatcher;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Str;

use function in_array;

final class FetchPackageInsights implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public function __construct(
        public readonly string $name,
    ) {
    }

    public function handle(IngressService $service, Dispatcher $bus): void
    {
        if (in_array($this->name, $service->ignoredPackages())) {
            return;
        }

        $vendor = Str::of($this->name)->beforeLast('/')->toString();
        $repo = Str::of($this->name)->afterLast('/')->toString();

        $connector = PackagistConnector::public();
        $response = $connector->send(new PackageDetails(
            vendor: $vendor,
            package: $repo,
        ));

        $package = PackageObject::fromArray(
            data: collect(
                $response->collect('packages')->first(),
            )->first()
        );

        $vendorModel = $service->ensureVendor(
            name: $vendor
        );

        $packageModel = $service->ensurePackage(
            payload: $package,
            repo: $repo,
            vendor: $vendorModel->id,
        );

        $stats = PackagistConnector::stats();
        $statsResponse = $stats->send(
            request: new PackageStatistics(
                vendor: $vendor,
                package: $repo,
            ),
        );

        $packageModel->update([
            'total_downloads' => $statsResponse->json('downloads.total'),
            'monthly_downloads' => $statsResponse->json('downloads.monthly'),
            'daily_downloads' => $statsResponse->json('downloads.daily'),
        ]);

        $statsResponse->collect('versions')->map(fn (string $version) => $packageModel->versions()->updateOrCreate([
            'name' => $version,
        ]));

        $advisories = $stats->send(
            request: new SecurityAdvisories(
                vendor: $vendor,
                package: $repo,
            ),
        );

        foreach ($advisories->json('advisories') as $package => $advisories) {

        }

        dd($advisories->json());
    }
}
