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
            $query->orWhereHas('return', function ($query) {
                $query->where('ticket_id', 'like', '%' . $this->searchTerm . '%');
                $query->whereHas('ticket', function ($query) {
                    $query->orWhereHas('contact', function ($query) {
                        $query->where('name', 'like', '%' . $this->searchTerm . '%');
                        $query->orWhere('email', 'like', '%' . $this->searchTerm . '%');
                        $query->orWhere('code', 'like', '%' . $this->searchTerm . '%');
                    });
                });
            });
        })
            ->orderBy('updated_at', 'desc')->paginate(10);
        return view('livewire.product-reports.index', compact('reports'));
    }

    #[On('updatedSearchTerm')]
    public function updateSearchTerm($searchTerm)
    {
        $this->searchTerm = $searchTerm;
        $this->goToPage(1);
    }
}
