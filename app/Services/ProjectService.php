<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Project;
use Illuminate\Database\DatabaseManager;

final readonly class ProjectService
{
    public function __construct(
        private DatabaseManager $database,
    ) {}

    public function create(string $name, string $user): Project
    {
        return $this->database->transaction(
            callback: fn () => Project::query()->create([
                'name' => $name,
                'user_id' => $user,
            ]),
            attempts: 3,
        );
    }
}
