<?php

use App\Models\Site;
use Livewire\Volt\Component;
use Livewire\Attributes\Validate;

new class extends Component {
    public $sites = null;

    public $title = 'no title';

    #[Validate('required|unique:sites,name,', as: 'Nom du site')]
    public $create_name;
    #[Validate('required', as: 'Description du site')]
    public $create_description;

    public $edit_id = '';
    public $edit_name;
    public $edit_description;

    public $delete_id = '';

    function loadSites()
    {
        $this->sites = Site::all();
    }
    function resetFields()
    {
        $this->create_name = '';
        $this->create_description = '';

        $this->edit_id = '';
        $this->edit_name = '';
        $this->edit_description = '';

        $this->delete_id = '';
    }
    function mount()
    {
        $this->loadSites();
    }

    function edit($id)
    {
        $this->edit_id = $id;

        $site = Site::where('id', $id)->first();

        $this->edit_name = $site->name;
        $this->edit_description = $site->description;
    }
    function delete($id)
    {
        $this->delete_id = $id;
    }
    function show()
    {
    }

    function createSite()
    {
        $this->validate();

        $site = new Site();
        $site->name = $this->create_name;
        $site->description = $this->create_description;

        $site->save();
        $this->loadSites();
        $this->dispatch('close-modal');
    }
    function editSite()
    {
        $this->validate([
            'edit_name' => 'required|unique:sites,name,' . $this->edit_id,
            'edit_description' => 'required',
        ]);

        $site = Site::where('id', $this->edit_id)->first();

        $site->name = $this->edit_name;
        $site->description = $this->edit_description;

        $site->save();
        $this->loadSites();
        $this->dispatch('close-modal');
    }
    function destroy()
    {
        $site = Site::findOrFail($this->delete_id);
        $site->delete();
        $this->loadSites();
        $this->dispatch('close-modal');
    }
}; ?>


<div class="">
    <h1>LISTE SITES</h1>
    <button data-modal-target="create-modal" data-modal-toggle="create-modal"
        class="bg-blue-200 hover:bg-blue-300 px-2 rounded-full">
        New
    </button>

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

    <!-- Create modal -->
    @include('livewire.pages.sites.modal-create')

    <!-- Edit modal -->
    @include('livewire.pages.sites.modal-edit')

    <!-- Delete modal -->
    @include('livewire.pages.sites.modal-delete')

    <!-- View modal -->
    @include('livewire.pages.sites.modal-show')


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
