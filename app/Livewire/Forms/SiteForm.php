<?php

namespace App\Livewire\Forms;

use App\Models\Site;
use DateTime;
use Livewire\Attributes\Rule;
use Livewire\Form;

class SiteForm extends Form
{
    public $id = "";
    #[Rule('required|unique:sites,name,', as: 'Nom du site')]
    public $name;
    #[Rule('required')]
    public $description;

    function setSite(Site $site)
    {
        $this->id = $site->id;
        $this->name = $site->name;
        $this->description = $site->description;
    }

    public function store()
    {
        $this->validate();
        Site::create($this->all());
        $this->reset();
    }
    public function update()
    {
        $this->validate([
            'name' => 'required|unique:sites,name,' . $this->id,
            'description' => 'required',
        ]);
        $site = Site::findOrFail($this->id);
        $site->name = $this->name;
        $site->description = $this->description;
        // $site->updated_At = new DateTime();
        $site->save();
        $this->reset();
    }
    public function destroy()
    {
        $site = Site::findOrFail($this->id);
        $site->delete();
        $this->reset();
    }
}