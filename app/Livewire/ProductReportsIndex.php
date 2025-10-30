<?php

namespace App\Livewire;

use App\Models\ProductReport;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class ProductReportsIndex extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public string $searchTerm = '';
    public function render()
    {
        $reports = ProductReport::where(function ($query) {
           $query->whereAny(['identifier'], 'like', '%' . $this->searchTerm . '%');
        })
        ->orderBy('updated_at', 'desc')->paginate(10);
        return view('livewire.product-reports.index', compact('reports'));
    }

    #[On('updatedSearchTerm')]
    public function updateSearchTerm($searchTerm)
    {
        $this->searchTerm = $searchTerm;
    }
}
