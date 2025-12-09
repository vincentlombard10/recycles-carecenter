<?php

namespace App\Providers;

use App\View\Composers\EstimateComposer;
use App\View\Composers\ProductReportComposer;
use App\View\Composers\ProductReturnComposer;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer('*', ProductReturnComposer::class);
        View::composer('*', EstimateComposer::class);
        View::composer('*', ProductReportComposer::class);
    }
}
