<?php

declare(strict_types=1);

namespace App\Livewire\Applications;

use App\Models\Application;
use App\Models\Package;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\View\Factory;
use Livewire\Component;
use Livewire\WithPagination;

final class PackageList extends Component
{
    use WithPagination;

    public Application $application;

    public function render(Factory $factory): View
    {
        return $factory->make(
            view: 'livewire.applications.package-list',
            data: [
                'packages' => Package::query()->with([
                    'versions',
                    'vendor',
                    'advisories',
                ])->whereHas(
                    'applications',
                    fn (Builder $builder) => $builder->where('application_id', $this->application->id),
                )->paginate(),
            ],
        );
    }
}
