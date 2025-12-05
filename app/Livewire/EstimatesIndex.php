<?php

namespace App\Livewire;

use App\Models\Estimate;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class EstimatesIndex extends Component
{
    use WithPagination;
    public $searchTerm;
    public function render()
    {
        $estimates = Estimate::paginate();
        return view('livewire.estimates.index', compact('estimates'));
    }

    #[On('updatedSearchTerm')]
    public function updateSearchTerm($searchTerm)
    {
        $this->searchTerm = $searchTerm;
    }
}
