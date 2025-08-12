<?php

namespace App\Livewire;

use App\Models\Ticket;
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
        $tickets = Ticket::orderBy('created_at', 'desc')->paginate(30);
        return view('livewire.tickets-index', compact('tickets'));
    }

    #[On('updatedSearchTerm')]
    public function updateSearchTerm($searchTerm)
    {
        $this->searchTerm = $searchTerm;
    }
}
