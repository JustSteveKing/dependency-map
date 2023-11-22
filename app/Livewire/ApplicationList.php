<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Models\Application;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\View\Factory;
use Livewire\Component;

final class ApplicationList extends Component
{
    public function render(Factory $factory): View
    {
        return $factory->make(
            view: 'livewire.application-list',
            data: [
                'applications' => Application::query()
                    ->whereHas(
                        'project',
                        fn (Builder $builder) => $builder->where('user_id', auth()->id()),
                    )->latest()->get(),
            ],
        );
    }
}
