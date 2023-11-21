<?php

declare(strict_types=1);

namespace App\Console\Commands\GitHub;

use App\Http\Integrations\GitHub\GitHubConnector;
use App\Http\Integrations\GitHub\Requests\ListRepositories;
use Illuminate\Console\Command;
use Symfony\Component\Console\Command\Command as SymfonyCommand;

final class Repositories extends Command
{
    protected $signature = 'github:repos';

    protected $description = 'List all public repositories from GitHub';

    public function handle(): int
    {
        $token = "";

        $connector = new GitHubConnector(
            token: $token,
        );

        $paginator = $connector->paginate(
            request: new ListRepositories(),
        );

        foreach ($paginator as $response) {
            dd($response->json());
        }

        return SymfonyCommand::SUCCESS;
    }
}
