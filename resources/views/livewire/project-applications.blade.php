<div class="border-t border-black/10 dark:border-white/10">
    <header class="flex items-center justify-between border-b border-black/5 dark:border-white/5 px-4 py-4 sm:px-6 sm:py-6 lg:px-8">
        <h1 class="text-base font-semibold leading-7">Applications</h1>
    </header>

    <ul role="list" class="divide-y divide-black/5 dark:divide-white/5">
        @forelse ($applications as $application)
            <li class="relative flex items-center space-x-4 px-4 py-4 sm:px-6 lg:px-8">
                <div class="min-w-0 flex-auto">
                    <div class="flex items-center gap-x-3">
                        <div class="flex-none rounded-full p-1 bg-gray-800/10 dark:bg-gray-100/10">
                            <div class="h-2 w-2 rounded-full bg-current"></div>
                        </div>
                        <h2 class="min-w-0 text-sm font-semibold leading-6">
                            <a wire:navigate href="{{ route('pages:applications:show', ['application' => $application]) }}" class="flex gap-x-2">
                                <span class="truncate">{{ $application->name }}</span>
                            </a>
                        </h2>
                    </div>
                    <div class="mt-3 flex items-center gap-x-2.5 text-xs leading-5 text-gray-400">
                        <p class="truncate">Dependency map updated</p>
                        <svg viewBox="0 0 2 2" class="h-0.5 w-0.5 flex-none fill-gray-300">
                            <circle cx="1" cy="1" r="1"></circle>
                        </svg>
                        <p class="whitespace-nowrap">{{ $application->updated_at->diffForHumans() }}</p>
                    </div>
                </div>
                <div class="rounded-full flex-none py-1 px-2 text-xs font-medium ring-1 ring-inset text-gray-400 bg-gray-400/10 ring-gray-400/20">Preview</div>
                <svg class="h-5 w-5 flex-none text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd"></path>
                </svg>
            </li>
        @empty
            <x-empty
                title="No applications"
                message="Get started by registering your application"
            >
                <button type="button" class="inline-flex items-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                    <svg class="-ml-0.5 mr-1.5 h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path d="M10.75 4.75a.75.75 0 00-1.5 0v4.5h-4.5a.75.75 0 000 1.5h4.5v4.5a.75.75 0 001.5 0v-4.5h4.5a.75.75 0 000-1.5h-4.5v-4.5z" />
                    </svg>
                    New Application
                </button>
            </x-empty>
        @endforelse
    </ul>

    <footer class="py-12">
        {{ $applications->links() }}
    </footer>
</div>
