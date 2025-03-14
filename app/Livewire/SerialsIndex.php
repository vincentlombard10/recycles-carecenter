<?php

namespace App\Livewire;

use App\Models\Serial;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;

class SerialsIndex extends Component
{
    use WithPagination;

    public $searchTerm;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $serials = Serial::where(function ($query) {
            $query->whereAny(['code', 'item_itno', 'customer_code'], 'like', '%' . $this->searchTerm . '%');
        })->paginate(15);

        return view('livewire.serials-index', compact('serials'));
    }

    #[On('updatedSearchTerm')]
    public function updateSerialsList($searchTerm = '')
    {
        $this->searchTerm = $searchTerm;
    }
}
