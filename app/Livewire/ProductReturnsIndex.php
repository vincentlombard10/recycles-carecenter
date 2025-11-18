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
    public string $status = '';
    public string $environment = 'production';

    public function render()
    {
        $items = ProductReturn::where(function ($query) {
            $query->whereAny(['identifier', 'serial_code', 'routing_from_code'], 'like', '%' . $this->searchTerm . '%');
        })
            ->when($this->trashed, function ($query) {
                return $query->onlyTrashed();
            })
            ->when($this->status, function ($query) {
                return $query->where('status', $this->status);
            })
            ->when($this->environment, function ($query) {
                return $query->where('environment', $this->environment);
            })
            ->orderBy('updated_at', 'desc')->paginate(10)->withQueryString();

        return view('livewire.product-returns.index', compact('items'));
    }

    #[On('updatedSearchTerm')]
    public function updateSearchTerm($searchTerm)
    {
        $this->searchTerm = $searchTerm;
        $this->goToPage(1);
    }

    public function updatedStatus(string $status)
    {
        $this->status = $status;
        $this->goToPage(1);
    }

    public function updatedEnvironment(string $environment)
    {
        $this->environment = $environment;
        $this->goToPage(1);
    }
}
