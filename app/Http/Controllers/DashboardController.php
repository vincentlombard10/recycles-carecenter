<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Item;
use App\Models\ProductReport;
use App\Models\ProductReturn;
use App\Models\Serial;
use App\Models\Ticket;
use DB;

class DashboardController extends Controller
{
    public function __invoke()
    {
        /* Contacts */
        $contacts_count = Contact::count();
        $contacts_with_support_enabled_count = Contact::whereNotNull('zendesk_user_id')->count();
        $contacts_with_support_disabled = Contact::where('support_enabled', false)->count();
        $contacts_with_duplicates_count = Contact::whereNotNull('duplicates')->count();
        $contacts_pending = Contact::whereNull('support_enabled')->count();

        $serials_count = Serial::count();
        $serials_without_item = Serial::doesntHave('item')->count();
        $serial_without_invoice_count = Serial::whereNull('last_invoice')->count();

        $items_count = Item::count();

        $tickets_open_count = Ticket::open()->count();
        $tickets_new_count = Ticket::new()->count();
        $tickets_new = Ticket::new()->get();
        $tickets_hold_or_pending_count = \App\Models\Ticket::holdOrPending()->count();

        $tickets_solved_this_year_count = Ticket::query()->whereIn('status', [Ticket::STATUS_SOLVED, Ticket::STATUS_CLOSED])
            ->where('created_at', '>', now()->startOfYear())
            ->where('solved_at', '<', now()->endOfYear())
            ->count();
        $first_reply_avg_time = Ticket::where('created_at', '>', now()->startOfYear())->avg('tickets.first_reply_time_in_minutes_within_business_hours');
        $full_resolution_avg_time = Ticket::where('created_at', '>', now()->startOfYear())->avg('tickets.full_resolution_time_in_minutes_within_business_hours');

        # Retours produits
        $product_returns_count = ProductReturn::inProduction()->count();
        $product_returns_pending_count = ProductReturn::where('status', ProductReturn::STATUS_PENDING)
            ->where('environment', ProductReturn::ENV_PRODUCTION)
            ->count();
        $product_returns_received_count = ProductReturn::where('status', ProductReturn::STATUS_RECEIVED)
            ->where('environment', ProductReturn::ENV_PRODUCTION)
            ->count();
        $product_returns_sandboxed_count = ProductReturn::where('environment', ProductReturn::ENV_SANDBOX)->count();

        $top_components = ProductReturn::select('item_itno', DB::raw('COUNT(*) as total'))
            ->groupBy('item_itno')
            ->orderBy('total', 'desc')
            ->get();
        dd($top_components);

        $product_reports_pending_count = ProductReport::where('status', 'pending')
            ->whereHas('return', function ($query) {
                $query->where('environment', ProductReturn::ENV_PRODUCTION);
            })
            ->count();
        $product_reports_in_progress_count = ProductReport::where('status', 'in_progress')
            ->whereHas('return', function ($query) {
                $query->where('environment', ProductReturn::ENV_PRODUCTION);
            })
            ->count();
        $product_reports_closed_count = ProductReport::where('status', 'closed')
            ->whereHas('return', function ($query) {
                $query->where('environment', ProductReturn::ENV_PRODUCTION);
            })
            ->count();
        $product_reports_duration_time = ProductReport::where('status', 'closed')
            ->whereHas('return', function ($query) {
                $query->where('environment', ProductReturn::ENV_PRODUCTION);
            })
            ->avg('duration_time_in_minutes_within_business_hours');

        return view('dashboard')
            ->with('product_returns_count', $product_returns_count)
            ->with('product_returns_pending_count', $product_returns_pending_count)
            ->with('product_returns_received_count', $product_returns_received_count)
            ->with('product_returns_sandboxed_count', $product_returns_sandboxed_count)
            ->with('contacts_count', $contacts_count)
            ->with('contacts_with_support_enabled_count', $contacts_with_support_enabled_count)
            ->with('contacts_with_support_disabled', $contacts_with_support_disabled)
            ->with('contacts_with_duplicates_count', $contacts_with_duplicates_count)
            ->with('contacts_pending', $contacts_pending)
            ->with('serials_count', $serials_count)
            ->with('serials_without_item', $serials_without_item)
            ->with('serial_without_invoice_count', $serial_without_invoice_count)
            ->with('tickets_open_count', $tickets_open_count)
            ->with('tickets_new_count', $tickets_new_count)
            ->with('tickets_new', $tickets_new)
            ->with('items_count', $items_count)
            ->with('tickets_solved_this_year_count', $tickets_solved_this_year_count)
            ->with('first_reply_avg_time', $first_reply_avg_time)
            ->with('full_resolution_avg_time', $full_resolution_avg_time)
            ->with('tickets_hold_or_pending_count', $tickets_hold_or_pending_count)
            ->with('product_reports_pending_count', $product_reports_pending_count)
            ->with('product_reports_in_progress_count', $product_reports_in_progress_count)
            ->with('product_reports_closed_count', $product_reports_closed_count)
            ->with('product_reports_duration_time', $product_reports_duration_time);
    }
}
