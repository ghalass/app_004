<?php

namespace App\Livewire;

use App\Models\Site;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithPagination;

class Sites extends Component
{
    // public $sites;

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
        // $this->sites = Site::all();
        // $this->sites = Site::orderBy('id', 'asc')->paginate(3);
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
    function show() {}

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

    // Q in updatedQ for q variable of search
    public function updatedQ()
    {
        $this->resetPage();
    }
    public function updatedPagination()
    {
        $this->resetPage();
    }
    use WithPagination;

    public $pagination = 10;
    public $q;
    public function render()
    {
        if (!$this->q) {
            $sites = Site::orderBy('id', 'desc')->paginate($this->pagination);
        } else {
            $sites = Site::where('name', 'like', '%' . $this->q . '%')
                ->orWhere('description', 'like', '%' . $this->q . '%')
                ->orderBy('id', 'desc')
                ->paginate($this->pagination);
        }

        return view('livewire.sites.index', [
            'sites' => $sites,
        ]);
    }
}
