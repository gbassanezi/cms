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
                                Role
                            </th>
                            <th
                                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-300 uppercase dark:bg-gray-400 ">
                                Route Name
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
                                        {{ $item->role }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-white whitespace-no-wrap">
                                        {{ $item->route_name }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-white whitespace-no-wrap">
                                    </td>
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

    <div class="mt-5 text-white">
        {{ $data->links() }}
    </div>

    <br />

    {{-- Form Modal --}}
    <x-dialog-modal wire:model="modalFormVisible">
        <x-slot name="title">
            {{ __('Save User Permission') }} {{ $modelId }}
        </x-slot>

        <x-slot name="content">
            <div class="mt-4">
                <x-label for="role" value="{{ __('Role') }}" />
                <select class="block w-full mt-1 dark:bg-gray-800" wire:model="role">
                    <option value="">-- Select the role --</option>
                    @foreach (App\Models\User::userRoleList() as $key => $value)
                        <option value="{{ $key }}">{{ $value }}</option>
                    @endforeach
                </select>
                <x-input-error for="role" class="mt-2" />
            </div>
            <div class="mt-4">
                <x-label for="routeName" value="{{ __('Route Name') }}" />
                <select class="block w-full mt-1 dark:bg-gray-800" wire:model="routeName">
                    <option value="">-- Select the Route Name --</option>
                    @foreach (App\Models\UserPermissions::routeNameList() as $item)
                        <option value="{{ $item }}">{{ $item }}</option>
                    @endforeach
                </select>
                <x-input-error for="routeName" class="mt-2" />
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
            {{ __('Delete User Permission') }}
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
