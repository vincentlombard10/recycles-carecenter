<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class PageHeader extends Component
{
    public function render(): View
    {
        return view('layouts.page-header');
    }
}
