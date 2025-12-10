<?php

namespace App\View\Composers;

use App\Models\Estimate;
use App\Models\ProductReturn;
use Illuminate\View\View;

class ProductReturnComposer
{
    public function compose(View $view)
    {
        $view->with('productReturnsCount', ProductReturn::count());
        $view->with('productReturnsPendingCount', ProductReturn::where('status', 'pending')->count());
    }
}
