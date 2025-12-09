<?php

namespace App\View\Composers;

use App\Models\ProductReport;
use Illuminate\View\View;

class ProductReportComposer
{
    public function compose(View $view)
    {
        $view->with('productReportsCount', ProductReport::count());
        $view->with('productReportsInProgressCount', ProductReport::where('status', 'in_progress')->count());
    }
}
