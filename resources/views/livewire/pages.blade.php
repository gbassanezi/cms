<div class="p-6">
    <div class="flex items-center justify-end px-4 py-3 text-right sm:px-6">
        <x-button wire:click='createShowModal'>
            {{ __('Create') }}
        </x-button>
    </div>

    {{-- Form Modal --}}
    <x-dialog-modal wire:model="modalFormVisible">
        <x-slot name="title">
            <x-label for="title" value="{{ __('Title') }}" />
            <x-input id="title" type="text" class="mt-1 block w-full" wire:model.debounce.800ms="title"
                autofocus />
            <x-input-error for="title" class="mt-2" /><br>
        </x-slot>

        <x-slot name="content">
            <x-label for="slug" value="{{ __('Slug') }}" />
            <div class="relative mb-4 flex flex-wrap items-stretch w-full">
                <span
                    class="flex items-center whitespace-nowrap rounded-l border border-r-0 border-solid border-neutral-300 px-3 py-[0.25rem] text-center text-base font-normal leading-[1.6] text-neutral-700 dark:border-neutral-600 dark:text-neutral-200 dark:placeholder:text-neutral-200"
                    >https://localhost/</span>
                <x-input type="text" id="slug" wire:model="slug" class="rounded dark:bg-gray-800" placeholder="slug here" />
                <x-input-error for="slug" class="mt-2" />
            </div>

                <x-label for="content" value="{{ __('Content') }}" />
                <x-input id="content" type="text" class="mt-1 block w-full"
                    wire:model.defer="createApiTokenForm.content" autofocus />
                <x-input-error for="content" class="mt-2" />
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('modalFormVisible')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-danger-button class="ml-3" wire:click="deleteUser" wire:loading.attr="disabled">
                {{ __('Save') }}
            </x-danger-button>
        </x-slot>
    </x-dialog-modal>
</div>
