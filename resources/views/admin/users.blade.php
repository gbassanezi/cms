<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Users') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="m-4 overflow-hidden bg-white shadow-xl dark:bg-gray-800 sm:rounded-lg">
                @livewire('users')
            </div>
        </div>
    </div>
</x-app-layout>
