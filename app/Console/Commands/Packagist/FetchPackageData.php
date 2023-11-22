<?php

declare(strict_types=1);

namespace App\Console\Commands\Packagist;

use App\DTOs\PackageObject;
use App\Http\Integrations\Packagist\PackagistConnector;
use App\Http\Integrations\Packagist\Requests\PackageDetails;
use App\Models\Package;
use App\Models\Vendor;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

final class FetchPackageData extends Command
{
    protected $signature = 'packagist:fetch';

    protected $description = 'Fetch Package data from Packagist.';

    public function handle(): int
    {
        $vendor = 'laravel';
        $package = 'breeze';

        $connector = PackagistConnector::public();

        $response = $connector->send(new PackageDetails(
            vendor: $vendor,
            package: $package,
        ));

        $package = PackageObject::fromArray(
            data: collect(
                $response->collect('packages')->first(),
            )->first()
        );

        // ensure vendor exists.
        $vendor = Vendor::query()->firstOrCreate(
            attributes: [
                'name' => $name = Str::of($package->name)->beforeLast('/'),
                'key' => Str::of($name)->lower()->slug()->toString(),
            ],
            values: [
                'key' => Str::of($name)->lower()->slug()->toString(),
            ],
        );

        // save the package
        Package::query()->updateOrCreate(
            attributes: [
                'name' => $package->name,
            ],
            values: [
                ...$package->toArray(),
                'key' => Str::of($package->name)->afterLast('/')->lower()->slug()->toString(),
                'vendor_id' => $vendor->getKey(),
            ],
        );

        return Command::SUCCESS;
    }
}
