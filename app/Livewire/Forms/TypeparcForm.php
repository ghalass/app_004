<?php

namespace App\Livewire\Forms;

use App\Models\Typeparc;
use Livewire\Form;

class TypeparcForm extends Form
{
    public $name;
    public $description;

    function rules()
    {
        return [
            'name' => 'required',
            'description' => 'required',
        ];
    }

    function resetForm()
    {
        $this->name = '';
        $this->description = '';
    }
    function save()
    {
        $this->validate();
        Typeparc::create([
            'name'          => $this->name,
            'description'   => $this->description,
        ]);
        return true;
    }
}