<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Application;
use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

final class ApplicationFactory extends Factory
{
    protected $model = Application::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence(),
            'project_id' => Project::factory(),
        ];
    }
}
