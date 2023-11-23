<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Advisory;
use App\Models\Package;
use Illuminate\Database\Eloquent\Factories\Factory;

final class AdvisoryFactory extends Factory
{
    protected $model = Advisory::class;

    public function definition(): array
    {
        return [
            'identifier' => $this->faker->uuid(),
            'affects' => $repo = $this->faker->userName() . '/' . $this->faker->userName(),
            'remote' => $remote = "{$repo}.{$this->faker->uuid()}.yaml",
            'title' => $this->faker->sentence(),
            'link' => "https://github.com/{$remote}",
            'cve' => "CVE-{$this->faker->year()}-{$this->faker->numberBetween(int1: 0000, int2: 9999)}",
            'versions' => $this->faker->semver(),
            'source' => 'FriendsOfPHP/security-advisories',
            'severity' => 'high',
            'package_id' => Package::factory(),
            'reported_at' => $this->faker->dateTime(),
        ];
    }
}
