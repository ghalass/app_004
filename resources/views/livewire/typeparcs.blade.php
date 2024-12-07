<div class="p-6 text-gray-900">
    <div class="mr-2 ">
        <x-primary-button wire:click='confirmTypeparcAdd' class="bg-blue-500 hover:bg-blue-700">
            New
        </x-primary-button>
    </div>
    <div>
        <div class="flex justify-between">
            <div class="p-2">
                <input wire:model.live.debounce.500ms="q" type="search"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    placeholder="Chercher...">
            </div>
            <div class="mr-2">
                <input type="checkbox" class="mr-2 leading-tight">Active Only?
            </div>
        </div>
        <table class="table table-auto w-full">
            <thead>
                <th class="px-4 py-2">
                    <div class="flex items-center">
                        <button wire:click="orderBy('id')">#</button>
                        <x-sort-icon sortField='id' :sort-by='$sortBy' :sort-asc='$sortAsc' />
                    </div>
                </th>
                <th class="px-4 py-2">
                    <div class="flex items-center">
                        <button wire:click="orderBy('name')">Site</button>
                        <x-sort-icon sortField='name' :sort-by='$sortBy' :sort-asc='$sortAsc' />
                    </div>
                </th>
                <th class="px-4 py-2">
                    <div class="flex items-center">
                        <button wire:click="orderBy('description')">Description</button>
                        <x-sort-icon sortField='description' :sort-by='$sortBy' :sort-asc='$sortAsc' />
                    </div>
                </th>
                <th class="px-4 py-2">Actions</th>
            </thead>
            <tbody>
                @foreach ($typeparcs as $typeparc)
                    <tr wire:key='{{ $typeparc->id }}'>
                        <td>{{ $typeparc->id }}</td>
                        <td>{{ $typeparc->name }}</td>
                        <td>{{ $typeparc->description }}</td>
                        <td>
                            <div class="flex space-x-1">
                                {{-- <button data-modal-target="edit-modal" data-modal-toggle="edit-modal"
                                    class="bg-transparent">
                                    <svg class="w-6 h-6 text-gray-300 hover:text-gray-400 dark:text-white"
                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                        height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M10.779 17.779 4.36 19.918 6.5 13.5m4.279 4.279 8.364-8.643a3.027 3.027 0 0 0-2.14-5.165 3.03 3.03 0 0 0-2.14.886L6.5 13.5m4.279 4.279L6.499 13.5m2.14 2.14 6.213-6.504M12.75 7.04 17 11.28" />
                                    </svg>

                                </button> --}}

                                {{-- <button wire:click='delete({{ $typeparc }})' data-modal-target="delete-modal"
                                    data-modal-toggle="delete-modal" class="bg-transparent">
                                    <svg class="w-6 h-6 text-red-300 hover:text-red-400 dark:text-white"
                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                        height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z" />
                                    </svg>
                                </button> --}}


                                {{-- <x-danger-button x-data=""
                                    x-on:click.prevent="$dispatch('open-modal', 'confirm-typeparc-deletion')">
                                    {{ __('Delete') }}
                                </x-danger-button> --}}


                                <x-primary-button wire:click="confirmTypeparcEdit('{{ $typeparc->id }}')"
                                    class="bg-orange-500 hover:bg-orange-700">
                                    Update
                                </x-primary-button>


                                <x-danger-button x-data=""
                                    wire:click="confirmTypeparcDeletion('{{ $typeparc->id }}')">
                                    {{ __('Delete') }}
                                </x-danger-button>





                                {{-- <button wire:click='show({{ $typeparc }})' data-modal-target="show-modal"
                                    data-modal-toggle="show-modal" class="bg-transparent  ">
                                    <svg class="w-6 h-6 text-green-300 hover:text-green-400 dark:text-white"
                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                        height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-width="2"
                                            d="M21 12c0 1.2-4.03 6-9 6s-9-4.8-9-6c0-1.2 4.03-6 9-6s9 4.8 9 6Z" />
                                        <path stroke="currentColor" stroke-width="2"
                                            d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    </svg>
                                </button> --}}
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $typeparcs->onEachSide(1)->links() }}</div>


    <x-modal name="confirm-typeparc-deletion">
        <form wire:submit="deleteTypeparc" class="p-6">

            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Are you sure you want to delete your account?') }}
            </h2>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-danger-button class="ms-3">
                    {{ __('Delete Account') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>


    <x-modal name="confirm-typeparc-add">
        <form wire:submit="saveTypeparc" class="p-6">

            <h2 class="text-lg font-medium text-gray-900">
                {{ isset($this->typeparc->id) ? 'Modifier un TYPEPARC' : "Ajout d'un nouveau TYPEPARC" }}
            </h2>

            <div>
                <x-input-label for="name" value="{{ __('Name') }}" />
                <x-text-input wire:model="name" id="name" name="name" type="text"
                    class="mt-1 block w-full" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="description" value="{{ __('Description') }}" />
                <x-text-input wire:model="description" id="description" name="description" type="text"
                    class="mt-1 block w-full" />
                <x-input-error :messages="$errors->get('description')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-danger-button class="ms-3">

                    {{ isset($this->typeparc->id) ? 'Modifier' : 'Ajouter' }}

                </x-danger-button>
            </div>
        </form>
    </x-modal>
</div>
