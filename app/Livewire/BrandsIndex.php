<?php

namespace App\Livewire;

use App\Models\Brand;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;
class BrandsIndex extends Component
{

    use WithPagination;
    private $searchTerm;

    public function render()
    {
        $brands = Brand::where(function ($query) {
            return $query->whereAny(['code', 'name'], 'like', '%' . $this->searchTerm . '%');
        })->orderBy('code')->paginate(10);
        return view('livewire.brands-index', compact('brands'));
    }

    #[On('updatedSearchTerm')]
    public function updateSearchTerm($searchTerm)
    {
        $this->searchTerm = $searchTerm;
        $this->goToPage(1);

    }
}
