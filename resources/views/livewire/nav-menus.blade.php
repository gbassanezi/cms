<div class="p-6">
    <div class="flex items-center justify-end px-4 py-3 text-right sm:px-6">
        <x-button wire:click='createShowModal'>
            {{ __('Create') }}
        </x-button>
    </div>

    {{-- The data table --}}
    <div class="flex flex-col">
        <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
            <div class="overflow-hidden border-b border-gray-200 shadow sm:rounded-lg">

                <table class="w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th
                                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-300 uppercase dark:bg-gray-400 ">
                                Label
                            </th>
                            <th
                                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-300 uppercase dark:bg-gray-400 ">
                                Sequence
                            </th>
                            <th
                                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-300 uppercase dark:bg-gray-400 ">
                                Type
                            </th>
                            <th
                                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-300 uppercase dark:bg-gray-400 ">
                                Url
                            </th>
                            <th
                                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-300 uppercase dark:bg-gray-400 ">
                            </th>
                            <th
                                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-300 uppercase dark:bg-gray-400 ">
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:bg-gray-800">
                        @if ($data->count())
                            @foreach ($data as $item)
                                <tr>
                                    <td class="px-6 py-4 text-sm text-white whitespace-no-wrap">
                                        {{ $item->type }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-white whitespace-no-wrap">
                                        {{ $item->sequence }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-white whitespace-no-wrap">
                                        {{ $item->label }}
                                    </td>
                                    <td class="px-6 py-4 text-sm whitespace-no-wrap">
                                        <a class="text-indigo-600 hover:text-indigo-900"
                                        target="_blank"
                                        href="{{ URL::to('/' . $item->slug) }}"
                                        >
                                            {{ $item->slug }}
                                        </a>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-white whitespace-no-wrap">{!! \Illuminate\Support\Str::limit($item->content, 50, '...') !!}</td>
                                    <td class="px-6 py-4 text-sm text-right">
                                        <x-button wire:click="updateShowModal({{ $item->id }})">
                                            {{ __('Update') }}
                                        </x-button>
                                        <x-danger-button wire:click="deleteShowModal({{ $item->id }})">
                                            {{ __('Delete') }}
                                            </x-button>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td class="px-6 py-4 text-sm text-center text-white whitespace-no-wrap" colspan="4">
                                    No Results Found</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <br />

    {{-- Form Modal --}}
    <x-dialog-modal wire:model="modalFormVisible">
        <x-slot name="title">
            {{ __('Save Navigation Menu') }} {{ $modelId }}
        </x-slot>

        <x-slot name="content">
            <div class="mt-4">
                <x-label for="label" value="{{ __('Label') }}" />
                <x-input id="label" type="text" class="block w-full mt-1" wire:model.debounce.800ms="label"
                    autofocus />
                <x-input-error for="label" class="mt-2" />
            </div>
            <div class="mt-4">
                <x-label for="slug" value="{{ __('Slug') }}" />
                    <div class="relative flex flex-wrap items-stretch w-full mb-4">
                        <span
                            class="flex items-center whitespace-nowrap rounded-l border border-r-0 border-solid border-neutral-300 px-3 py-[0.25rem] text-center text-base font-normal leading-[1.6] text-neutral-700 dark:border-neutral-600 dark:text-neutral-200 dark:placeholder:text-neutral-200">https://localhost/</span>
                        <x-input type="text" id="slug" wire:model="slug" class="rounded dark:bg-gray-800"
                            placeholder="slug here" />
                    </div>
                    <x-input-error for="slug" class="mt-2" /><br>
            </div>
            <div class="mt-4">
                <x-label for="sequence" value="{{ __('Sequence') }}" />
                <x-input id="sequence" type="text" class="block w-full mt-1" wire:model.debounce.800ms="sequence"
                    autofocus />
                <x-input-error for="sequence" class="mt-2" />
            </div>
            <div class="mt-4">
                <x-label for="type" value="{{ __('Type') }}" />
                <select class="block w-full mt-1 dark:bg-gray-800" wire:model="type">
                    <option value="SidebarNav">Sidebar Nav</option>
                    <option value="TopNav">Top Nav</option>
                </select>
                <x-input-error for="type" class="mt-2" />
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('modalFormVisible')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>

            @if ($modelId)
                <x-button class="ml-2" wire:click="update" wire:loading.attr="disabled">
                    {{ __('Update') }}
                </x-button>
            @else
                <x-button class="ml-2" wire:click="create" wire:loading.attr="disabled">
                    {{ __('Create') }}
                </x-button>
            @endif
        </x-slot>
    </x-dialog-modal>

    {{-- Delete Modal --}}
    <x-dialog-modal wire:model="modalConfirmDeleteVisible">
        <x-slot name="title">
            {{ __('Delete Page') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Are you sure you want to delete Nav item?') }}
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('modalConfirmDeleteVisible')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-danger-button class="ml-2" wire:click="delete" wire:loading.attr="disabled">
                {{ __('Delete Nav Menu') }}
            </x-danger-button>
        </x-slot>
    </x-dialog-modal>
</div>
