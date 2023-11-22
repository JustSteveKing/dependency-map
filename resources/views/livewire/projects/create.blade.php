<form wire:submit.prevent="submit" class="md:col-span-2">
    <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:max-w-xl sm:grid-cols-6">

        <div class="sm:col-span-3">
            <label for="name" class="block text-sm font-medium leading-6 text-white">Project Name</label>
            <div class="my-2">
                <input wire:model="name" type="text" name="name" id="name" autocomplete="off" class="block w-full rounded-md border-0 bg-white/5 py-1.5 text-black dark:text-white shadow-sm ring-1 ring-inset ring-black/10 dark:ring-white/10 focus:ring-2 focus:ring-inset focus:ring-indigo-500 sm:text-sm sm:leading-6">
            </div>
            @error('name')
                <div class="my-2">
                    @foreach ($errors->get('name') as $message)
                        <p class="text-red-600 dark:text-red-400">{{ $message }}</p>
                    @endforeach
                </div>
            @enderror
        </div>

    </div>

    <div class="mt-8 flex">
        <button type="submit" class="rounded-md bg-indigo-500 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">Save</button>
    </div>
</form>
