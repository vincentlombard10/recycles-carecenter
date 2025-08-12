<?php

namespace App\Http\Controllers;

use App\Models\ProductReport;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Devrabiul\ToastMagic\Facades\ToastMagic;

class ProductReportController extends Controller
{
    public function index()
    {
        $reports_count = ProductReport::count();
        return view('reports.index', compact('reports_count'));
    }

    public function create()
    {
        return view('reports.create');
    }

    public function store(Request $request)
    {
    }

    public function edit(string $identifier)
    {
        $report = ProductReport::where('identifier', $identifier)->firstOrFail();
        return view('reports.edit', compact('report'));
    }

    public function update(Request $request, $id)
    {
        $productReport = ProductReport::findOrFail($id);
        $productReport->update([
            'battery_key' => self::getBooleanValue($request->battery_key),
            'antitheft_key' => self::getBooleanValue($request->antitheft_key),
            'charger' => self::getBooleanValue($request->charger),
            'battery' => self::getBooleanValue($request->battery),
            'pedals' => self::getBooleanValue($request->pedals),
            'front_wheel' => self::getBooleanValue($request->front_wheel),
            'rear_wheel' => self::getBooleanValue($request->rear_wheel),
            'saddle' => self::getBooleanValue($request->saddle),
            'seatpost' => self::getBooleanValue($request->seatpost),
            'display' => self::getBooleanValue($request->display),
            'motor' => self::getBooleanValue($request->motor),
            'presence_comment' => $request->presence_comment,

            'stripes' => self::getBooleanValue($request->stripes),
            'corrosion' => self::getBooleanValue($request->corrosion),
            'clay' => self::getBooleanValue($request->clay),
            'sand' => self::getBooleanValue($request->sand),
            'impacts' => self::getBooleanValue($request->impacts),
            'cracks' => self::getBooleanValue($request->cracks),
            'breakages' => self::getBooleanValue($request->breakages),
            'customizations' => self::getBooleanValue($request->customizations),
            'check_comment' => $request->check_comment,

            'issue_comment' => $request->issue_comment,

            'battery_reference' => $request->battery_reference,
            'battery_serial' => $request->battery_serial,
            'battery_type' => $request->battery_type,
            'battery_voltage' => $request->battery_voltage,
            'battery_capacity' => $request->battery_capacity,
            'battery_look' => $request->battery_look,
            'battery_charge' => self::getBooleanValue($request->battery_charge),
            'battery_issue' => $request->battery_issue,
            'battery_current_voltage' => $request->battery_current_voltage,

            'battery_energy' => $request->battery_energy,
            'battery_cycles' => $request->battery_cycles,
            'battery_cells_state' => $request->battery_cells_state,
            'battery_current_capacity' => $request->battery_current_capacity,
            'battery_temperature' => $request->battery_temperature,
            'battery_internal_resistance' => $request->battery_internal_resistance,

            'diagnostic' => $request->diagnostic,
        ]);
        return redirect()->route('support.reports.index');
    }

    public function destroy($id): RedirectResponse
    {
        return redirect()->route('reports.index');
    }

    private function getBooleanValue($field): bool
    {
        return filter_var($field, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
    }
}
