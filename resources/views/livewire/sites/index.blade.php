<div class="">
    <h1>LISTE SITES</span></h1>

    <div class="flex items-center mb-2 gap-2">
        <button data-modal-target="create-modal" data-modal-toggle="create-modal"
            class="bg-blue-200 hover:bg-blue-300 px-2 rounded-full">
            New
        </button>

        <div class="">
            <input wire:model.live="q"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                placeholder="Chercher...">
        </div>
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

    @foreach ($sites as $site)
        <div wire:key class="flex gap-1 my-1">

            <button wire:click='edit({{ $site->id }})' data-modal-target="edit-modal" data-modal-toggle="edit-modal"
                class="bg-gray-200 hover:bg-gray-300 px-2 rounded-full">
                Edit
            </button>

            <button wire:click='delete({{ $site->id }})' data-modal-target="delete-modal"
                data-modal-toggle="delete-modal" class="bg-red-200 hover:bg-red-300 px-2 rounded-full">
                Delete
            </button>

            <button wire:click='show' data-modal-target="show-modal" data-modal-toggle="show-modal"
                class="bg-green-200 hover:bg-green-300 px-2 rounded-full">
                Show
            </button>

            <p>{{ $site->name }}</p>
        </div>
    @endforeach

    <span>{{ $sites->links() }}</span>



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
