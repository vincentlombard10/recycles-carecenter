<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class ReportsIndex extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $searchTerm;

    public function render()
    {
        return view('livewire.reports-index');
    }

    #[On('updatedSearchTerm')]
    public function updateSearchTerm($searchTerm)
    {
        $this->searchTerm = $searchTerm;
    }
}
