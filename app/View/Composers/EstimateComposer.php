<?php

namespace App\View\Composers;

use App\Models\Estimate;
use Illuminate\View\View;

class EstimateComposer
{
    public function compose(View $view)
    {
        $view->with('estimatesCount', Estimate::count());
        $view->with('estimatesPendingCount', Estimate::where('state', 'pending')->count());
    }
}
