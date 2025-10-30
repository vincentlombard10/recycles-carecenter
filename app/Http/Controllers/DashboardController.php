<?php

namespace App\Http\Controllers;

use App\Models\ProductReport;
use App\Models\ProductReturn;
use App\Models\Serial;
use App\Models\Ticket;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $serials_count = Serial::count();
        $serials_without_item = Serial::doesntHave('item')->count();
        $serial_without_invoice_count = Serial::whereNull('last_invoice')->count();

        $tickets_open_count = Ticket::open()->count();
        $tickets_new_count = Ticket::new()->count();
        $tickets_new = Ticket::new()->get();
        $tickets_hold_or_pending_count = \App\Models\Ticket::holdOrPending()->count();

        $product_returns_pending_count = ProductReturn::where('status', 'pending')->count();
        $product_reports_pending_count = ProductReport::where('status', 'pending')->count();
        $product_reports_in_progress_count = ProductReport::where('status', 'in_progress')->count();

        return view('dashboard')
            ->with('serials_count', $serials_count)
            ->with('serials_without_item', $serials_without_item)
            ->with('serial_without_invoice_count', $serial_without_invoice_count)
            ->with('tickets_open_count', $tickets_open_count)
            ->with('tickets_new_count', $tickets_new_count)
            ->with('tickets_new', $tickets_new)
            ->with('tickets_hold_or_pending_count', $tickets_hold_or_pending_count)
            ->with('product_returns_pending_count', $product_returns_pending_count)
            ->with('product_reports_pending_count', $product_reports_pending_count)
            ->with('product_reports_in_progress_count', $product_reports_in_progress_count);
    }
}
