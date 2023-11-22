<?php

declare(strict_types=1);

\Laravel\Folio\middleware(['auth']);

\Laravel\Folio\name('pages:projects:create'); ?>

<x-page title="Create New Project">
    <div class="divide-y divide-black/5 dark:divide-white/5">
        <div class="grid max-w-7xl grid-cols-1 gap-x-8 gap-y-10 px-4 py-16 sm:px-6 md:grid-cols-3 lg:px-8">
            <div>
                <h2 class="text-base font-semibold leading-7 text-black dark:text-white">
                    Project Information
                </h2>
                <p class="mt-1 text-sm leading-6">
                    Use this form to create a Project.
                </p>
            </div>

            <livewire:projects.create />
        </div>
    </div>
</x-page>
