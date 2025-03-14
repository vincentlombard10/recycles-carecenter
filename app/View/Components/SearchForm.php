<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SearchForm extends Component
{
    public string $searchTerm = 'oulala';

    public function render()
    {
        return view('components.search-form');
    }

    public function updated() {

    }
}
