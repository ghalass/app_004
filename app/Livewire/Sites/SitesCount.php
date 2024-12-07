<?php

namespace App\Livewire\Sites;

use Livewire\Attributes\Reactive;
use Livewire\Component;

class SitesCount extends Component
{
    #[Reactive]
    public $count;
    function mount($count)
    {
        $this->count = $count;
    }

    public function render()
    {
        return view('livewire.sites.sites-count');
    }
}