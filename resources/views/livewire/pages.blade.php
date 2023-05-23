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
                                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase dark:bg-gray-400 ">
                                Title</th>
                            <th
                                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase dark:bg-gray-400 ">
                                Link</th>
                            <th
                                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase dark:bg-gray-400 ">
                                Content</th>
                            <th
                                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase dark:bg-gray-400 ">
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:bg-gray-800">
                        @if ($data->count())
                            @foreach ($data as $item)
                                <tr>
                                    <td class="px-6 py-4 text-sm whitespace-no-wrap">
                                        {{ $item->title }}
                                        {!! $item->is_default_home ? '<span class="text-xs font-bold text-green-400">[Default Home Page]</span>' : '' !!}
                                        {!! $item->is_default_not_found ? '<span class="text-xs font-bold text-red-400">[Default 404 Page]</span>' : '' !!}
                                    </td>
                                    <td class="px-6 py-4 text-sm whitespace-no-wrap">
                                        <a class="text-indigo-600 hover:text-indigo-900" target="_blank"
                                            href="{{ URL::to('/' . $item->slug) }}">
                                            {{ $item->slug }}
                                        </a>
                                    </td>
                                    <td class="px-6 py-4 text-sm whitespace-no-wrap">{!! \Illuminate\Support\Str::limit($item->content, 50, '...') !!}</td>
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
                                <td class="px-6 py-4 text-sm whitespace-no-wrap" colspan="4">No Results Found</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <br />
    {{ $data->links() }}

    {{-- Form Modal --}}
    <x-dialog-modal wire:model="modalFormVisible">
        <x-slot name="title">
            <x-label for="title" value="{{ __('Title') }}" />
            <x-input id="title" type="text" class="block w-full mt-1" wire:model.debounce.800ms="title"
                autofocus />
            <x-input-error for="title" class="mt-2" /><br>
        </x-slot>
        <x-slot name="content">
            <x-label for="slug" value="{{ __('Slug') }}" />
            <div class="relative flex flex-wrap items-stretch w-full mb-4">
                <span
                    class="flex items-center whitespace-nowrap rounded-l border border-r-0 border-solid border-neutral-300 px-3 py-[0.25rem] text-center text-base font-normal leading-[1.6] text-neutral-700 dark:border-neutral-600 dark:text-neutral-200 dark:placeholder:text-neutral-200">https://localhost/</span>
                <x-input type="text" id="slug" wire:model="slug" class="rounded dark:bg-gray-800"
                    placeholder="slug here" />
                <x-input-error for="slug" class="mt-2" />
            </div>
            <x-label for="content" value="{{ __('Content') }}" />
            <div class="rounded-md shadow-sm">
                <div class="mt-1 bg-white">
                    <div class="body-content" wire:ignore>
                        <trix-editor id="content" class="trix-content" x-ref="trix" wire:model="content"
                            wire:key="trix-content-unique-key"></trix-editor>
                    </div>
                </div>
            </div>
            <x-input-error for="content" class="mt-2" />
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('modalFormVisible')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>

            @if ($modelId)
                <x-button class="ml-2" wire:click="update" wire:loading.attr="disabled">
                    {{ __('Update') }}
                    </x-danger-button>
                @else
                    <x-button class="ml-2" wire:click="create" wire:loading.attr="disabled">
                        {{ __('Create') }}
                        </x-danger-button>
            @endif
        </x-slot>
    </x-dialog-modal>
</div>
