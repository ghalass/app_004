<?php

namespace App\Livewire;

use App\Models\Typeparc;
use Livewire\Component;
use Livewire\WithPagination;

class Typeparcs extends Component
{
    use WithPagination;

    public $active;
    public $q;
    public $sortBy = 'id';
    public $sortAsc = true;
    public $typeparc;

    public $name;
    public $description;

    public $confirmingTypeparcDeletion = false;
    public $confirmingTypeparcAdd = false;

    protected $queryString = [
        'q' => ['except' => ''],
        'sortBy' => ['except' => 'id'],
        'sortAsc' => ['except' => true],
    ];

    protected $rules = [
        'name'     => 'required|string|min:4',
        'description'  => 'required|string|min:4',
    ];

    public function render()
    {
        $typeparcs = Typeparc::where('name', 'like', '%' . $this->q . '%')
            ->orWhere('description', 'like', '%' . $this->q . '%')
            ->orderBy($this->sortBy, $this->sortAsc ? 'ASC' : 'DESC');

        $typeparcs = $typeparcs->paginate(10);

        $data = [
            'typeparcs' => $typeparcs,
        ];
        return view('livewire.typeparcs', $data);
    }
    public function updatedQ()
    {
        $this->resetPage();
    }
    public function updatedPagination()
    {
        $this->resetPage();
    }
    public function orderBy($field)
    {
        // $this->js('alert("ok")');
        if ($field == $this->sortBy) {
            $this->sortAsc = !$this->sortAsc;
        }
        $this->sortBy = $field;
    }
    public function confirmTypeparcDeletion($id)
    {
        $this->confirmingTypeparcDeletion = $id;
        // $this->js('alert("' . $this->confirmingTypeparcDeletion . '")');
        $this->dispatch('open-modal', 'confirm-typeparc-deletion');
    }
    public function deleteTypeparc()
    {
        $typeparc = Typeparc::where('id', $this->confirmingTypeparcDeletion);
        $typeparc->delete();
        $this->confirmingTypeparcDeletion = false;
        $this->dispatch('close-modal', 'confirm-typeparc-deletion');
        $this->dispatch('warning', ['message' => 'Supprimé avec succès!']);
    }

    public function confirmTypeparcAdd()
    {
        $this->reset(['typeparc']);
        $this->name = '';
        $this->description = '';
        $this->confirmingTypeparcAdd = true;
        $this->dispatch('open-modal', 'confirm-typeparc-add');
    }
    public function saveTypeparc()
    {
        // $this->js('alert("saveTypeparc")');
        $this->validate();

        if (isset($this->typeparc->id)) {
            $typeparc = Typeparc::findOrFail($this->typeparc->id);
            $typeparc->name = $this->name;
            $typeparc->description = $this->description;
            $typeparc->save();
            $this->reset();
            $this->dispatch('info', ['message' => 'Modifié avec succès!']);
        } else {
            Typeparc::create([
                'name' => $this->name,
                'description' => $this->description
            ]);
            $this->dispatch('success', ['message' => 'Ajouté avec succès!']);
        }
        $this->confirmingTypeparcAdd = false;
        $this->dispatch('close-modal', 'confirm-typeparc-add');
    }

    public function confirmTypeparcEdit(Typeparc $typeparc)
    {
        $this->typeparc = $typeparc;

        $this->name = $typeparc->name;
        $this->description = $typeparc->description;
        $this->dispatch('open-modal', 'confirm-typeparc-add');
    }
}
