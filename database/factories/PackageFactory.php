<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Package;
use App\Models\Vendor;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

final class PackageFactory extends Factory
{
    protected $model = Package::class;

    public function definition(): array
    {
        return [
            'name' => $name = $this->faker->unique()->words(asText: true),
            'key' => Str::slug($name),
            'description' => $this->faker->realText(),
            'homepage' => $this->faker->url(),
            'license' => 'MIT', // enum
            'source' => $this->faker->url(),
            'type' => 'project', // enum
            'total_downloads' => $total = $this->faker->numberBetween(
                int1: 100,
                int2: 10_000_000,
            ),
            'monthly_downloads' => $total / 2,
            'daily_downloads' => $total / 10,
            'vendor_id' => Vendor::factory(),
        ];
    }
}
