<?php

namespace App\Livewire\Sites;

use App\Models\Site;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class SitesList extends Component
{
    use WithPagination;

    // private $sitesList = [];
    // private $qq = '';

    function placeholder()
    {
        return view('livewire.placeholder');
    }

    // #[On('Q_Changed')]
    // public function search($q)
    // {
    //     // $this->qq = $q;
    //     // $this->js('console.log("' . $q . '")');
    //     // $this->js('console.log("OK")');

    //     // if (!$this->q) {
    //     //     $this->sitesList = Site::orderBy('id', 'desc')->paginate(5);
    //     // } else {
    //     //     $this->sitesList = Site::where('name', 'like', '%' . $this->q . '%')
    //     //         ->orWhere('description', 'like', '%' . $this->q . '%')
    //     //         ->orderBy('id', 'desc')
    //     //         ->paginate(5);
    //     // }
    // }

    #[On(['site-created'])]
    public function render()
    {
        return view('livewire.sites.sites-list', [
            'sites' => Site::orderBy('id', 'desc')->paginate(5),
            'count' => Site::count(),
        ]);
    }
}