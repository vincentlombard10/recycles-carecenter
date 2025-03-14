<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class TicketsIndex extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $searchTerm;

    public function render()
    {
        return view('livewire.tickets-index');
    }

    #[On('updatedSearchTerm')]
    public function updateSearchTerm($searchTerm)
    {
        $this->searchTerm = $searchTerm;
    }
}
