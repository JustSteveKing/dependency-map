<?php

declare(strict_types=1);

\Laravel\Folio\middleware(['auth']);

\Laravel\Folio\name('pages:projects:show'); ?>

<x-page :title="$project->name">
    <section>
        <header>
            <div class="flex flex-col items-start justify-between gap-x-8 gap-y-4 bg-gray-200/10 dark:bg-gray-700/10 px-4 py-4 sm:flex-row sm:items-center sm:px-6 lg:px-8">
                <div>
                    <div class="flex items-center gap-x-3">
                        <div class="flex-none rounded-full bg-green-400/10 p-1 text-green-400">
                            <div class="h-2 w-2 rounded-full bg-current"></div>
                        </div>
                        <h1 class="flex gap-x-3 text-base leading-7">
                            <span class="font-semibold text-black dark:text-white">{{ $project->name }}</span>
                        </h1>
                    </div>
                    <p class="mt-2 text-xs leading-6">
                        Last checked {{ $project->updated_at->diffForHumans() }}
                    </p>
                </div>
                <div class="order-first flex-none rounded-full bg-indigo-400/10 px-2 py-1 text-xs font-medium text-indigo-400 ring-1 ring-inset ring-indigo-400/30 sm:order-none">
                    Production
                </div>
            </div>

            <div class="grid grid-cols-1 bg-gray-200/10 dark:bg-gray-700/10 sm:grid-cols-2 lg:grid-cols-4">
                <div class="border-t border-black/5 dark:border-white/5 py-6 px-4 sm:px-6 lg:px-8 ">
                    <p class="text-sm font-medium leading-6">Number of deploys</p>
                    <p class="mt-2 flex items-baseline gap-x-2">
                        <span class="text-4xl font-semibold tracking-tight text-black dark:text-white">405</span>
                    </p>
                </div>
                <div class="border-t border-black/5 dark:border-white/5 py-6 px-4 sm:px-6 lg:px-8 sm:border-l">
                    <p class="text-sm font-medium leading-6">Average deploy time</p>
                    <p class="mt-2 flex items-baseline gap-x-2">
                        <span class="text-4xl font-semibold tracking-tight text-black dark:text-white">3.65</span>
                        <span class="text-sm">mins</span>
                    </p>
                </div>
                <div class="border-t border-black/5 dark:border-white/5 py-6 px-4 sm:px-6 lg:px-8 lg:border-l">
                    <p class="text-sm font-medium leading-6">Number of servers</p>
                    <p class="mt-2 flex items-baseline gap-x-2">
                        <span class="text-4xl font-semibold tracking-tight text-black dark:text-white">3</span>
                    </p>
                </div>
                <div class="border-t border-black/5 dark:border-white/5 py-6 px-4 sm:px-6 lg:px-8 sm:border-l">
                    <p class="text-sm font-medium leading-6">Success rate</p>
                    <p class="mt-2 flex items-baseline gap-x-2">
                        <span class="text-4xl font-semibold tracking-tight text-black dark:text-white">98.5%</span>
                    </p>
                </div>

            </div>
        </header>

        <livewire:project-applications
            :project="$project"
        />
    </section>
</x-page>
