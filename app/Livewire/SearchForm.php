<?php

namespace App\Livewire;

use Livewire\Component;
use function Laravel\Prompts\search;

class SearchForm extends Component
{
    public string $searchTerm = "";
    public function render()
    {
        return view('livewire.search-form');
    }

    public function updatedSearchTerm()
    {
        $this->dispatch('updatedSearchTerm', searchTerm: $this->searchTerm);
    }
}
