<?php

declare(strict_types=1);

namespace App\Jobs\Packagist;

use App\DTOs\PackageObject;
use App\Http\Integrations\Packagist\PackagistConnector;
use App\Http\Integrations\Packagist\Requests\PackageDetails;
use App\Services\IngressService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Str;

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

    public function handle(IngressService $service): void
    {
        if (\in_array($this->name, $service->ignoredPackages())) {
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

        $packageModel =$service->ensurePackage(
            payload: $package,
            repo: $repo,
            vendor: $vendorModel->id,
        );


        // register versions
        // get stats
        // get downloads
    }
}
