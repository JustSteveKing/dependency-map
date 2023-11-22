<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Models\Project;
use Illuminate\Contracts\View\View;
use Illuminate\View\Factory;
use Livewire\Component;
use Livewire\WithPagination;

final class ProjectList extends Component
{
    use WithPagination;

    public function render(Factory $factory): View
    {
        return $factory->make(
            view: 'livewire.project-list',
            data: [
                'projects' => Project::query()->latest()->where('user_id', auth()->id())->paginate(),
            ],
        );
    }
}
