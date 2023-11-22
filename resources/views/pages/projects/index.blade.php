<?php

declare(strict_types=1);

\Laravel\Folio\middleware(['auth']);

\Laravel\Folio\name('pages:projects:index'); ?>

<x-page title="Your Projects">

    <livewire:project-list />

    <section class="bg-white/10 dark:bg-black/10 lg:fixed lg:bottom-0 lg:right-0 lg:top-16 lg:w-96 lg:overflow-y-auto lg:border-l lg:border-black/5 dark:lg:border-white/5">
        <header class="flex items-center justify-between border-b border-black/5 dark:border-white/5 px-4 py-4 sm:px-6 sm:py-6 lg:px-8">
            <h2 class="text-base font-semibold leading-7">Activity feed</h2>
            <a href="#" class="text-sm font-semibold leading-6 text-indigo-400">View all</a>
        </header>
        <ul role="list" class="divide-y divide-black/5 dark:divide-white/5">
            <li class="px-4 py-4 sm:px-6 lg:px-8">
                <div class="flex items-center gap-x-3">
                    <img src="https://images.unsplash.com/photo-1519244703995-f4e0f30006d5?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=facearea&amp;facepad=2&amp;w=256&amp;h=256&amp;q=80" alt="" class="h-6 w-6 flex-none rounded-full bg-gray-800">
                    <h3 class="flex-auto truncate text-sm font-semibold leading-6">Michael Foster</h3>
                    <time datetime="2023-01-23T11:00" class="flex-none text-xs">1h</time>
                </div>
                <p class="mt-3 truncate text-sm">Pushed to <span class="text-gray-400">ios-app</span> (<span class="font-mono text-gray-400">2d89f0c8</span> on <span class="text-gray-400">main</span>)</p>
            </li>
        </ul>
    </section>
</x-page>
