<?php

namespace App\Console\Commands\Packagist;

use App\Http\Integrations\Packagist\PackagistConnector;
use App\Http\Integrations\Packagist\Requests\PackageDetails;
use App\Http\Integrations\Packagist\Requests\PackageStatistics;
use App\Models\Package;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class FetchPackageStats extends Command
{
    protected $signature = 'packagist:stats';

    protected $description = 'Fetch Package stats from Packagist.';

    public function handle(): int
    {
        $model = Package::query()->first();

        $vendor = Str::of($model->name)->beforeLast('/')->toString();
        $package = Str::of($model->name)->afterLast('/')->toString();

        $connector = PackagistConnector::stats();

        $response = $connector->send(new PackageStatistics(
            vendor: $vendor,
            package: $package,
        ));

        $model->update([
            'total_downloads' => $response->json('downloads.total'),
            'monthly_downloads' => $response->json('downloads.monthly'),
            'daily_downloads' => $response->json('downloads.daily'),
        ]);

        $response->collect('versions')->map(fn (string $version) => $model->versions()->updateOrCreate([
            'name' => $version,
        ]));

        return Command::SUCCESS;
    }
}
