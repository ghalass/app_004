<?php

namespace App\Livewire;

use App\Livewire\Forms\TypeparcForm;
use App\Models\Typeparc;
use Livewire\Component;
use Livewire\WithPagination;

class TypeparcComponent extends Component
{
    use WithPagination;
    // Properties
    public TypeparcForm $typeparcForm; // form object

    public $isModalOpen = false;
    public $typeparcs;
    public $editingTypeparcId = null;

    function mount()
    {
        $this->typeparcForm = new TypeparcForm($this, 'typeparcForm');
    }

    function resetForm()
    {
        $this->typeparcForm = new TypeparcForm($this, 'typeparcForm');
    }

    function showModal()
    {
        $this->isModalOpen = true;
    }

    function closeModal()
    {
        $this->isModalOpen = false;
        $this->editingTypeparcId = null;
    }

    function saveTypeparc()
    {
        $this->validate();

        if (!$this->getErrorBag()->isEmpty()) {
            $this->isModalOpen = true;
            return;
        }

        $saved = $this->typeparcForm->save();

        if ($saved) {
            session()->flash('message', 'Typeparc ajouté avec succès!');
            $this->isModalOpen = false;
        }
    }
    function editTypeparc($id)
    {
        $typeparc = Typeparc::find($id);
        $this->typeparcForm->fill($typeparc->toArray());
        $this->editingTypeparcId = $id;
        $this->isModalOpen = true;
    }
    function updateTypeparc()
    {
        $this->typeparcForm->validate();

        if (!$this->getErrorBag()->isEmpty()) {
            $this->isModalOpen = true;
            return;
        }

        $typeparc = Typeparc::find($this->editingTypeparcId);
        $typeparc->update($this->typeparcForm->toArray());
        $this->editingTypeparcId = null;
        session()->flash('message', 'Typeparc modifié avec succès!');
        $this->typeparcForm->resetForm();
        $this->isModalOpen = false;
    }
    function deleteTypeparc($id)
    {
        Typeparc::find($id)->delete();
        session()->flash('message', 'Typeparc supprimé avec succès!');
    }

    public function render()
    {
        // $this->typeparcs = Typeparc::paginate(10);
        // $this->typeparcs = Typeparc::all();
        return view(
            'typeparcs',
            [
                'typeparcs' => Typeparc::paginate(10)
            ]
        );
    }
}
