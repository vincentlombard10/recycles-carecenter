<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;

class ChangeLogIndex extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $searchTerm;

    public function render()
    {
        return view('livewire.changelog.index');
    }
}
