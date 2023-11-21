<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

final class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'nickname' => $this->faker->userName(),
            'email' => $this->faker->unique()->companyEmail(),
            'avatar' => $this->faker->imageUrl(),
            'provider_id' => Str::random(),
            'access_token' => Str::random(),
            'refresh_token' => Str::random(),
        ];
    }
}
