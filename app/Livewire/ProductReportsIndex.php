<?php

namespace App\Livewire;

use App\Models\ProductReport;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class ProductReportsIndex extends Component
{
    use WithPagination;

    public string $searchTerm = '';
    public string $status = '';
    public string $environment = 'production';

    public function render()
    {
        $reports = ProductReport::where(function ($query) {
            $query->whereAny(['identifier'], 'like', '%' . $this->searchTerm . '%');
            $query->orWhereHas('return', function ($query) {
                $query->where('ticket_id', 'like', '%' . $this->searchTerm . '%');
                $query->orWhereHas('ticket', function ($query) {
                    $query->whereHas('contact', function ($query) {
                        $query->where('name', 'like', '%' . $this->searchTerm . '%');
                        $query->orWhere('email', 'like', '%' . $this->searchTerm . '%');
                        $query->orWhere('code', 'like', '%' . $this->searchTerm . '%');
                    });
                });
            });
        })
            ->when($this->status, function ($query) {
                return $query->where('status', $this->status);
            })
            ->when($this->environment, function ($query) {
                return $query->whereHas('return', function ($query) {
                    $query->where('environment', $this->environment);
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
