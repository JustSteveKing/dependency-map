<?php

declare(strict_types=1);

namespace App\Console\Commands\Packagist;

use App\Http\Integrations\Packagist\PackagistConnector;
use App\Http\Integrations\Packagist\Requests\SecurityAdvisories;
use App\Models\Package;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

final class FetchPackageAdvisories extends Command
{
    protected $signature = 'packagist:advisories';

    protected $description = 'Fetch Package advisories from Packagist.';

    public function handle(): void
    {
        $model = Package::query()->first();

        $vendor = Str::of($model->name)->beforeLast('/')->toString();
        $package = Str::of($model->name)->afterLast('/')->toString();

        $connector = PackagistConnector::stats();

        $response = $connector->send(new SecurityAdvisories(
            vendor: $vendor,
            package: $package,
        ));

        dd($response->json());
    }
}
