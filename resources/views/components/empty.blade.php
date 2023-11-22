@props([
    'title',
    'message',
])

<li class="text-center py-12">
    <x-icon name="project" class="mx-auto h-12 w-12" />
    <h3 class="mt-2 text-sm font-semibold">{{ $title }}</h3>
    <p class="mt-1 text-sm">{{ $message }}</p>
    <div class="mt-6">
        {{ $slot }}
    </div>
</li>
