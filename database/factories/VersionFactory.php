<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Package;
use App\Models\Version;
use Illuminate\Database\Eloquent\Factories\Factory;

final class VersionFactory extends Factory
{
    protected $model = Version::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->semver(),
            'package_id' => Package::factory(),
        ];
    }
}
