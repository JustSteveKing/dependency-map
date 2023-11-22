<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Maintainer;
use Illuminate\Database\Eloquent\Factories\Factory;

final class MaintainerFactory extends Factory
{
    protected $model = Maintainer::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->company(),
            'url' => $this->faker->url(),
        ];
    }
}
