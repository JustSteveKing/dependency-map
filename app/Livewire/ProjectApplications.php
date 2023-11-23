<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Models\Application;
use App\Models\Project;
use Illuminate\Contracts\View\View;
use Illuminate\View\Factory;
use Livewire\Component;

final class ProjectApplications extends Component
{
    public Project $project;

    public function render(Factory $factory): View
    {
        return $factory->make(
            view: 'livewire.project-applications',
            data: [
                'applications' => Application::query()->with([
                    'project'
                ])->where(
                    'project_id',
                    $this->project->getKey(),
                )->paginate(),
            ],
        );
    }
}
