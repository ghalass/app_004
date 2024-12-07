<div class="">
    <div class="flex items-center mb-2 gap-2">
        <button wire:click='create' data-modal-target="create-modal" data-modal-toggle="create-modal"
            class="bg-transparent">
            <svg class="w-6 h-6 text-blue-300 hover:text-blue-400 dark:text-white " aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 7.757v8.486M7.757 12h8.486M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>

        </button>

        <div class="">
            <input wire:model.live.debounce.500ms="q"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                placeholder="Chercher...">

            {{-- <livewire:sites.sites-search :q="$q" /> --}}


        </div>
        <button wire:click='clearSerach' class="bg-transparent flex">
            <svg class="w-6 h-6 text-gray-400 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M5 12h14M5 12l4-4m-4 4 4 4" />
            </svg>
            <span class="text-gray-400">Effacer</span>
        </button>

        <div class="">
            <select wire:model.live='pagination'
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-16 p-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                <option value="10">10</option>
                <option value="20">20</option>
                <option value="50">50</option>
                <option value="100">100</option>
            </select>
        </div>
    </div>

    <livewire:sites.sites-list lazy />

    {{-- <livewire:sites.sites-form /> --}}

    @script
        <script>
            // window.addEventListener('open-create-modal', event => {
            //     console.log('open-create-modal');
            // });

            window.addEventListener('close-modal', event => {
                window.FlowbiteInstances.
                getInstance('Modal', 'create-modal')?.
                hide();

                window.FlowbiteInstances.
                getInstance('Modal', 'edit-modal')?.
                hide();

                window.FlowbiteInstances.
                getInstance('Modal', 'create-modal')?.
                hide();

                window.FlowbiteInstances.
                getInstance('Modal', 'delete-modal')?.
                hide();
            });
        </script>
    @endscript
</div>
