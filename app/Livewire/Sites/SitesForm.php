<?php

namespace App\Livewire\Sites;

use App\Livewire\Forms\SiteForm;
use App\Models\Site;
use Livewire\Attributes\On;
use Livewire\Component;

class SitesForm extends Component
{
    public SiteForm $form;

    function create()
    {
        $this->form->reset();
    }
    function createSite()
    {
        $this->form->store();
        $this->dispatch('close-modal');
        $this->dispatch('success', ['message' => 'Ajouté avec succès!']);
        $this->dispatch('site-created');
    }

    // function editSite()
    // {
    //     $this->form->update();
    //     $this->dispatch('close-modal');
    //     $this->dispatch('info', ['message' => 'Modifié avec succès!']);
    //     $this->dispatch('site-updated');
    // }

    // function destroy()
    // {
    //     $this->form->destroy();
    //     $this->dispatch('close-modal');
    //     $this->dispatch('warning', ['message' => 'Supprimé avec succès!']);
    //     $this->dispatch('site-deleted');
    // }


    public function render()
    {
        return view('livewire.sites.sites-form');
    }
}