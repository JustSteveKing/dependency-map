<?php

declare(strict_types=1);

namespace App\Livewire\Projects;

use App\Services\ProjectService;
use Illuminate\Contracts\View\View;
use Illuminate\View\Factory;
use Livewire\Attributes\Rule;
use Livewire\Component;

final class Create extends Component
{
    #[Rule(['required','string','min:2','max:255'])]
    public string $name;

    public function submit(ProjectService $service): void
    {
        $this->validate();

        $service->create(
            name: $this->name,
            user: auth()->id(),
        );

        $this->redirect(
            url: route('pages:projects:index'),
        );
    }

    public function render(Factory $factory): View
    {
        return view('livewire.projects.create');
//        return $factory->make(
//            view: 'livewire.projects.create',
//        );
    }
}
