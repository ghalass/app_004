<div>
    <div x-data="{ isOpen: @entangle('isModalOpen') }">
        <button @click="isOpen = true; @this.set('isModalOpen', true)" class="bg-transparent">
            <svg class="w-6 h-6 text-blue-300 hover:text-blue-400 dark:text-white " aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 7.757v8.486M7.757 12h8.486M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>
        </button>

        <div x-cloak x-show="isOpen" x-transition: opacity.duration. 500ms
            class="fixed inset-0 bg-gray-500
        bg-opacity-75 flex items-center justify-center" tabindex="-1">
            <div class="bg-white rounded-1g w-1/2">
                <div class="">
                    <div class="bg-gray-200 p-3 flex justify-between items-center rounded-t-1g">

                        <h5 class="text-1g font-semibold">
                            {{ $editingTypeparcId ? 'Modifier Typeparc' : 'Ajouter Typeparc' }}
                        </h5>

                        <button type="button" class="text-gray-700 hover:text-gray-900 transition duration-300"
                            @click="isOpen = false; @this.set('isModalOpen', false)" aria-label="close">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    <div class="p-5">
                        <form wire:submit="{{ $editingTypeparcId ? 'updateTypeparc' : 'saveTypeparc' }}">

                            <div class="mb-4">
                                <label wire:model='typeparcForm.name'
                                    class="block text-gray-700 text-sm font-bold mb-2">Nom</label>
                                <input type="text" class="w-full p-2 border rounded">

                                @error('typeparcForm.name')
                                    <p class="text-red-300 italic text-sm">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2">Description</label>
                                <input wire:model='typeparcForm.description' type="text"
                                    class="w-full p-2 border rounded">
                                @error('typeparcForm.description')
                                    <span class="text-red-400 text-sm italic">{{ $message }}</span>
                                @enderror


                                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700">
                                    {{ $editingTypeparcId ? 'Modifier' : 'Ajouter' }}
                                </button>
                        </form>
                    </div>
                </div>
            </div>


            @if (session()->has('message'))
                <div class="bg-green-100 border-1-4 border-green-500 text-green-700 p-4 mt-3" role="alert">
                    {{ session('message') }}
                </div>
            @endif
        </div>
    </div>
    <table class="min-w-full bg-white mt-4 shadow-md rounded-1g">
        <thead>
            <tr>
                <th class="py-2 px-4 border-b text-left">Nom</th>
                <th class="py-2 px-4 border-b text-left">Description</th>
                <th class="py-2 px-4 border-b text-left">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($typeparcs as $typeparc)
                <tr wire:key>
                    <td class="py-2 px-4 border-b">{{ $typeparc->name }}</td>
                    <td class="py-2 px-4 border-b">{{ $typeparc->description }}</td>
                    <td class="py-2 px-4 border-b flex space-x-2">
                        <button wire:click='editTypeparc({{ $typeparc->id }})' class="bg-transparent">
                            <svg class="w-full h-full text-gray-300 hover:text-gray-400 dark:text-white"
                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M10.779 17.779 4.36 19.918 6.5 13.5m4.279 4.279 8.364-8.643a3.027 3.027 0 0 0-2.14-5.165 3.03 3.03 0 0 0-2.14.886L6.5 13.5m4.279 4.279L6.499 13.5m2.14 2.14 6.213-6.504M12.75 7.04 17 11.28" />
                            </svg>
                        </button>
                        <button wire:click='deleteTypeparc({{ $typeparc->id }})' class="bg-transparent">
                            <svg class="w-full h-full text-red-300 hover:text-red-400 dark:text-white"
                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z" />
                            </svg>
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
