<?php

namespace App\Livewire\Sites;

use Livewire\Attributes\Reactive;
use Livewire\Component;

class SitesSearch extends Component
{
    // #[Reactive]
    public $q = 'ghalass';
    function mount($q)
    {
        $this->q = $q;
    }

    function updatedQ()
    {
        $this->dispatch('Q_Changed', q: $this->q);
    }
    public function render()
    {
        return view('livewire.sites.sites-search');
    }
}