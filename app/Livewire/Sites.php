<?php

namespace App\Livewire;

use App\Livewire\Forms\SiteForm;
use App\Models\Site;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithPagination;

class Sites extends Component
{
    // public $sites;

    public SiteForm $form;

    // public $edit_id = '';
    // public $edit_name;
    // public $edit_description;

    // public $delete_id = '';

    // function loadSites()
    // {
    //     // $this->sites = Site::all();
    //     // $this->sites = Site::orderBy('id', 'asc')->paginate(3);
    // }
    function resetFields()
    {
        // $this->create_name = '';
        // $this->create_description = '';

        // $this->edit_id = '';
        // $this->edit_name = '';
        // $this->edit_description = '';

        // $this->delete_id = '';
    }
    function mount()
    {
        // $this->loadSites();
    }
    function create()
    {
        $this->form->reset();
        // // $this->edit_id = $id;

        // $site = Site::where('id', $this->form->id)->first();

        //  $site->name;
        // $this->edit_description = $site->description;
    }
    function edit(?Site $site)
    {
        $this->form->setSite($site);
        // // $this->edit_id = $id;

        // $site = Site::where('id', $this->form->id)->first();

        //  $site->name;
        // $this->edit_description = $site->description;
    }
    function delete(?Site $site)
    {
        $this->form->setSite($site);
        // $this->delete_id = $id;
    }
    function show() {}

    function createSite()
    {
        // $this->validate();

        // $site = new Site();
        // $site->name = $this->form;
        // $site->description = $this->create_description;
        $this->form->store();

        // $site->save();
        // $this->loadSites();
        $this->dispatch('close-modal');
        $this->dispatch('success', ['message' => 'Ajouté avec succès!']);
    }
    function editSite()
    {
        // $this->form->setSite($site);
        $this->form->update();

        // $this->validate([
        //     'edit_name' => 'required|unique:sites,name,' . $this->edit_id,
        //     'edit_description' => 'required',
        // ]);

        // $site = Site::where('id', $this->edit_id)->first();

        // $site->name = $this->edit_name;
        // $site->description = $this->edit_description;

        // $site->save();
        // $this->loadSites();
        $this->dispatch('close-modal');
        $this->dispatch('info', ['message' => 'Modifié avec succès!']);
    }
    function destroy()
    {
        // dd($this->form);
        // $this->form->setSite($site);
        $this->form->destroy();

        // // $site = Site::findOrFail($this->delete_id);
        // // $site->delete();
        // // $this->loadSites();
        $this->dispatch('close-modal');
        $this->dispatch('warning', ['message' => 'Supprimé avec succès!']);
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
        sleep(1);
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