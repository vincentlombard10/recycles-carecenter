<?php

namespace App\Livewire;

use App\Models\ProductReturn;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class ProductReturnsIndex extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public string $searchTerm = '';
    public bool $trashed = false;

    public function render()
    {
        $items = ProductReturn::where(function ($query) {
            $query->whereAny(['identifier', 'serial_code', 'from_code'], 'like', '%' . $this->searchTerm . '%');
        })
            ->when($this->trashed, function ($query) {
                return $query->onlyTrashed();
            })
            ->orderBy('created_at', 'desc')->paginate(10);

        return view('livewire.product-returns.index', compact('items'));
    }

    #[On('updatedSearchTerm')]
    public function updateSearchTerm($searchTerm)
    {
        $this->searchTerm = $searchTerm;
    }
}
