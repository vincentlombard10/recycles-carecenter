<?php

namespace App\Http\Controllers;

use App\Models\BatteryState;
use App\Models\Item;
use App\Models\ProductReport;
use App\Models\ReplacementItem;
use Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Devrabiul\ToastMagic\Facades\ToastMagic;
use Illuminate\Support\Facades\Log;
use Matrix\Exception;

class ProductReportController extends Controller
{
    public function index()
    {
        $closed_reports = ProductReport::where('status', '=', 'closed')->get();
        foreach($closed_reports as $report){
            $report->where('status', 'closed')->update(['duration_time_in_seconds' => $report->started_at->diffInSeconds($report->closed_at)]);
        }

        if(!Auth::check() && !Auth::user()->can('reports.read')) {
            \ToastMagic::error('You do not have permission to access this page.');
            return redirect()->route('dashboard');
        }
        $reports_count = ProductReport::count();
        return view('reports.index', compact('reports_count'));
    }

    public function create()
    {
        if(!Auth::user()->can('reports.create')) {
            \ToastMagic::error('You do not have permission to access this page.');
            return redirect()->route('dashboard');
        }
        if (!auth()->user()->hasAnyPermission('reports.create')) {
            return redirect()->back()->with('message', 'You are not authorized to use this functionality!');
        }
        return view('reports.create');
    }

    public function store(Request $request)
    {
    }

    public function start(Request $request, $id)
    {
        if(!Auth::user()->can('reports.update')) {
            \ToastMagic::error('You do not have permission to access this page.');
            return redirect()->route('dashboard');
        }
        try {
            ProductReport::find($id)->update([
                'started_at' => now(),
                'technician_id' => auth()->user()->id,
                'status' => ProductReport::STATUS_IN_PROGRESS
            ]);
        } catch (Exception $exception) {
            ToastMagic::error($exception->getMessage());
            return redirect()->back();
        }

        return redirect()->route('support.reports.edit', ProductReport::find($id)->identifier);
    }

    public function edit(string $identifier)
    {
        if(!Auth::user()->can('reports.update')) {
            \ToastMagic::error('You do not have permission to access this page.');
            return redirect()->route('dashboard');
        }
        if (!auth()->user()->hasAnyPermission('reports.update')) {
            return redirect()->back()->with('message', 'You are not authorized to use this functionality!');
        }
        $report = ProductReport::where('identifier', $identifier)->firstOrFail();
        return view('reports.edit', compact('report'));
    }

    public function update(Request $request, $id)
    {

        $productReport = ProductReport::findOrFail($id);
        $bls = $productReport->batteryStates->pluck('id')->toArray();
        $presenceChecks = self::getPresenceChecks(
            battery_key: $request->battery_key,
            lock_key: $request->lock_key,
            charger: $request->charger,
            battery: $request->battery,
            pedals: $request->pedals,
            front_wheel: $request->front_wheel,
            rear_wheel: $request->rear_wheel,
            saddle: $request->saddle,
            seatpost: $request->seatpost,
            display: $request->display,
            motor: $request->motor,
            comment: $request->presence_comment,
        );
        $look_checks = self::getLookChecks(
            stripes: $request->stripes,
            corrosion: $request->corrosion,
            clay: $request->clay,
            sand: $request->sand,
            impacts: $request->impacts,
            cracks: $request->cracks,
            breakage: $request->breakage,
            modification: $request->modification,
            comment: $request->look_comment,
        );
        $other_info = self::getChecksOtherInformation(odo: $request->odo);
        $checks_diagnostics = self::getChecksDiagnostic(
            description: $request->description,
            defect: $request->defect,
            tests: $request->tests,
        );
        $battery_identification = self::getBatteryIdentification(
            reference: $request->battery_reference,
            serial: $request->battery_serial,
            type: $request->battery_type,
            voltage: $request->battery_nominal_voltage,
            capacity: $request->battery_nominal_capacity,
        );
        if ($request->battery_look_states) {
            foreach ($request->battery_look_states as $state) {
                if ($state !== "other") {
                    $bls[] = BatteryState::where('identifier', $state)->first()->id;
                }
            }
        }
        $battery_look = self::getBatteryLook(
            look: json_encode($request->battery_look_states),
            custom: $request->battery_look_custom_state ?? null,
            fault: $request->battery_look_fault,
        );
        $battery_tests = self::getBatteryTests(
            indicator: $request->battery_indicator,
            errors: $request->battery_error_codes,
            state: $request->battery_charge_state,
            voltage: $request->battery_charge_voltage,
            energy: $request->battery_energy,
        );
        $diagnostic = self::getDiagnostic(
            cycles: $request->battery_charge_cycles,
            cells_state: $request->battery_cells_state,
            capacity: $request->battery_usable_capacity,
            temperature: $request->battery_temperature,
            resistance: $request->battery_internal_resistance,
            comment: $request->diagnostic,
        );
        $other = [
            'status' => $request->status ?? $productReport->status,
            'order' => $request->order,
        ];
        $data = [...$presenceChecks, ...$look_checks, ...$other_info, ...$checks_diagnostics, ...$battery_identification, ...$battery_look, ...$battery_tests, ...$diagnostic, ...$other];

        $productReport->update($data);
        $productReport->replacementItems()->delete();
        $productReport->batteryStates()->sync($bls);
        if ($request->replacement_item_itno) {
            foreach($request->replacement_item_itno as $key => $value) {
                try {
                    $replacement_item = ReplacementItem::create([
                        'itno' => $request->replacement_item_itno[$key],
                        'itds' => $request->replacement_item_itds[$key],
                        'care' => $request->replacement_item_care[$key] === "true" ? 1 : 0,
                        'quantity' => $request->replacement_item_quantity[$key],
                        'item_id' => Item::where('itno', $request->replacement_item_itno[$key])->first()->id ?? null,
                        'productreport_id' => $productReport->id,
                    ]);
                } catch (Exception $e) {
                    Log::error($e->getMessage());
                }
            }
        }
        return redirect()->route('support.reports.index');
    }

    public function destroy($id): RedirectResponse
    {
        if(!Auth::user()->can('reports.delete')) {
            \ToastMagic::error('You do not have permission to access this page.');
            return redirect()->route('dashboard');
        }
        return redirect()->route('reports.index');
    }

    private function getBooleanValue($field): bool
    {
        return filter_var($field, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
    }

    private function getPresenceChecks(
        string|null $battery_key,
        string|null $lock_key,
        string|null $charger,
        string|null $battery,
        string|null $pedals,
        string|null $front_wheel,
        string|null $rear_wheel,
        string|null $saddle,
        string|null $seatpost,
        string|null $display,
        string|null $motor,
        string|null $comment,
    ): array {
        return [
            'battery_key' => $battery_key,
            'lock_key' => $lock_key,
            'charger' => $charger,
            'battery' => $battery,
            'pedals' => $pedals,
            'front_wheel' => $front_wheel,
            'rear_wheel' => $rear_wheel,
            'saddle' => $saddle,
            'seatpost' => $seatpost,
            'display' => $display,
            'motor' => $motor,
            'presence_comment' => $comment,
        ];
    }

    private function getLookChecks(
        string|null $stripes,
        string|null $corrosion,
        string|null $clay,
        string|null $sand,
        string|null $impacts,
        string|null $cracks,
        string|null $breakage,
        string|null $modification,
        string|null $comment,
    ): array
    {
        return [
            'stripes' => $stripes,
            'corrosion' => $corrosion,
            'clay' => $clay,
            'sand' => $sand,
            'impacts' => $impacts,
            'cracks' => $cracks,
            'breakage' => $breakage,
            'modification' => $modification,
            'look_comment' => $comment,
        ];
    }

    private function getChecksOtherInformation(
        string|null $odo
    ): array{
        return [
            'odo' => $odo,
        ];
    }

    private function getChecksDiagnostic(
        string|null $description,
        string|null $defect,
        string|null $tests,
    ): array {
        return [
            'description' => $description,
            'defect' => $defect,
            'tests' => $tests,
        ];
    }

    private function getBatteryIdentification(
        string|null $reference,
        string|null $serial,
        string|null $type,
        string|null $voltage,
        string|null $capacity,
    ): array
    {
        return [
            'battery_reference' => $reference,
            'battery_serial' => $serial,
            'battery_type' => $type,
            'battery_nominal_voltage' => $voltage,
            'battery_nominal_capacity' => $capacity,
        ];
    }

    private function getBatteryLook(
        string|null $look,
        string|null $custom,
        string|null $fault,
    ): array
    {
        return [
            'battery_look_states' => $look,
            'battery_look_custom_state' => $custom,
            'battery_look_fault' => $fault,
        ];
    }


    private function getBatteryTests(
        string|null $indicator,
        string|null $errors,
        string|null $state,
        string|null $voltage,
        string|null $energy,
    ): array {
        return [
            'battery_indicator' => $indicator,
            'battery_error_codes' => $errors,
            'battery_charge_state' => $state,
            'battery_charge_voltage' => $voltage,
            'battery_energy' => $energy,
        ];
    }

    private function getDiagnostic(
        string|null $cycles,
        string|null $cells_state,
        string|null $capacity,
        string|null $temperature,
        string|null $resistance,
        string|null $comment,
    ): array
    {
        return [
            'battery_charge_cycles' => $cycles,
            'battery_cells_state' => $cells_state,
            'battery_usable_capacity' => $capacity,
            'battery_temperature' => $temperature,
            'battery_internal_resistance' => $resistance,
            'diagnostic' => $comment,
        ];
    }
}
