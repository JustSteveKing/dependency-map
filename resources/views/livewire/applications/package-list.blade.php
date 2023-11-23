<section>
    <ul role="list" class="divide-y divide-black/5 dark:divide-white/5">
        @foreach ($packages as $package)
            <li class="relative flex items-center space-x-4 px-4 py-4 sm:px-6 lg:px-8">
                <div class="min-w-0 flex-auto">
                    <div class="flex items-center gap-x-3">
                        <div class="flex-none rounded-full p-1 bg-gray-800/10 dark:bg-gray-100/10">
                            <div class="h-2 w-2 rounded-full bg-current"></div>
                        </div>
                        <h2 class="min-w-0 text-sm font-semibold leading-6 text-black dark:text-white">
                            <a href="#" class="flex gap-x-2">
                                <span class="truncate">{{ $package->name }}</span>
                                <span class="absolute inset-0"></span>
                            </a>
                        </h2>
                    </div>
                    <div class="mt-3 flex items-center gap-x-2.5 text-xs leading-5">
                        <p class="">{{ $package->description }}</p>
                    </div>
                </div>
                <div class="rounded-full flex-none py-1 px-2 text-xs font-medium ring-1 ring-inset text-gray-400 bg-blue-400/10 ring-gray-400/20">
                    {{ $package->license }}
                </div>
                <svg class="h-5 w-5 flex-none text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd"></path>
                </svg>
            </li>
        @endforeach
    </ul>

    <footer class="py-12 px-4">
        {{ $packages->links() }}
    </footer>
</section>
