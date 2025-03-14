<?php

namespace App\Livewire;

use App\Models\Item;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
class ItemsIndex extends Component
{
    use WithPagination;
    public $searchTerm;
    protected $paginationTheme = 'bootstrap';
    public function render()
    {
        $items = Item::where(function ($query) {
            $query->whereAny(['itno', 'itds'], 'like', '%' . $this->searchTerm . '%');
        })->paginate(15);;
        return view('livewire.items-index', compact('items'));
    }

    #[On('updatedSearchTerm')]
    public function updateItemsList($searchTerm)
    {
        $this->searchTerm = $searchTerm;
    }
}
