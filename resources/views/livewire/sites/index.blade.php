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
            <input wire:model.live="q"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                placeholder="Chercher...">
        </div>
        <div class="">
            <select wire:model.live='pagination'
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-16 p-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="20">20</option>
                <option value="50">50</option>
                <option value="100">100</option>
            </select>
        </div>
    </div>

    @foreach ($sites as $site)
        <div wire:key class="flex gap-1 my-1">


            <button wire:click='edit({{ $site }})' data-modal-target="edit-modal" data-modal-toggle="edit-modal"
                class="bg-transparent">
                <svg class="w-6 h-6 text-gray-300 hover:text-gray-400 dark:text-white" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10.779 17.779 4.36 19.918 6.5 13.5m4.279 4.279 8.364-8.643a3.027 3.027 0 0 0-2.14-5.165 3.03 3.03 0 0 0-2.14.886L6.5 13.5m4.279 4.279L6.499 13.5m2.14 2.14 6.213-6.504M12.75 7.04 17 11.28" />
                </svg>

            </button>

            <button wire:click='delete({{ $site }})' data-modal-target="delete-modal"
                data-modal-toggle="delete-modal" class="bg-transparent">
                <svg class="w-6 h-6 text-red-300 hover:text-red-400 dark:text-white" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z" />
                </svg>
            </button>

            <button wire:click='show({{ $site }})' data-modal-target="show-modal" data-modal-toggle="show-modal"
                class="bg-transparent  ">
                <svg class="w-6 h-6 text-green-300 hover:text-green-400 dark:text-white" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-width="2"
                        d="M21 12c0 1.2-4.03 6-9 6s-9-4.8-9-6c0-1.2 4.03-6 9-6s9 4.8 9 6Z" />
                    <path stroke="currentColor" stroke-width="2" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                </svg>
            </button>


            <p>{{ $site->name }}</p>
        </div>
    @endforeach

    <div class="mt-4">{{ $sites->onEachSide(1)->links() }}</div>



    <!-- Create modal -->
    @include('livewire.sites.modal-create')

    <!-- Edit modal -->
    @include('livewire.sites.modal-edit')

    <!-- Delete modal -->
    @include('livewire.sites.modal-delete')

    <!-- View modal -->
    @include('livewire.sites.modal-show')


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
