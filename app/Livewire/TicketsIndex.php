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
        $tickets = Ticket::where(function ($query) {
            $query->where('id', 'like', '%' . $this->searchTerm . '%');
        })
            ->select('id', 'tickets.first_reply_time_in_minutes_within_business_hours')
            ->withCount('fields', 'comments')
            ->orderBy('created_at', 'desc')->paginate(30);
        return view('livewire.tickets-index', compact('tickets'));
    }

    #[On('updatedSearchTerm')]
    public function updateSearchTerm($searchTerm)
    {
        $this->searchTerm = $searchTerm;
    }
}
