<?php

namespace App\Http\Resources;

use App\Models\ProductReport;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin ProductReport */
class ProductReportResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'identifier' => $this->identifier,
            'type' => $this->type,
            'batteryKey' => $this->battery_key,
            'lockKey' => $this->lock_key,
            'charger' => $this->charger,
            'battery' => $this->battery,
            'pedals' => $this->pedals,
            'frontWheel' => $this->front_wheel,
            'rearWheel' => $this->rear_wheel,
            'saddle' => $this->saddle,
            'seatpost' => $this->seatpost,
            'display' => $this->display,
            'motor' => $this->motor,
            'presenceComment' => $this->presence_comment,
            'odo' => $this->odo,
            'description' => $this->description,
            'defect' => $this->defect,
            'tests' => $this->tests,

            'stripes' => $this->stripes,
            'corrosion' => $this->corrosion,
            'clay' => $this->clay,
            'sand' => $this->sand,
            'impacts' => $this->impacts,
            'cracks' => $this->cracks,
            'breakage' => $this->breakage,
            'modification' => $this->modification,
            'lookComment' => $this->look_comment,

            'batteryReference' => $this->battery_reference,
            'batterySerial' => $this->battery_serial,
            'batteryType' => $this->battery_type,
            'batteryNominalVoltage' => $this->battery_nominal_voltage,
            'batteryNominalCapacity' => $this->battery_nominal_capacity,
            'batteryLookStates' => $this->battery_look_states,
            'batteryLookCustomState' => $this->battery_look_custom_state,
            'batteryIndicator' => $this->battery_indicator,
            'batteryErrorCodes' => $this->battery_error_codes,
            'batteryChargeState' => $this->battery_charge_state,
            'batteryChargeVoltage' => $this->battery_charge_voltage,
            'batteryEnergy' => $this->battery_energy,
            'batteryBmsState' => $this->bms_state,
            'batteryChargeCycles' => $this->battery_charge_cycles,
            'batteryCellsState' => $this->battery_cells_state,
            'batteryVirtualUsableCapacity' => $this->battery_usable_capacity,
            'batteryTemperature' => $this->battery_temperature,
            'batteryInternalResistance' => $this->battery_internal_resistance,
            'diagnostic' => $this->diagnostic,
            'status' => $this->status,

            'customizations' => $this->customizations,
            'checkComment' => $this->check_comment,
            'issueComment' => $this->issue_comment,
            'batteryVoltage' => $this->battery_voltage,
            'batteryCapacity' => $this->battery_capacity,
            'batteryLook' => $this->battery_look,
            'batteryCharge' => $this->battery_charge,
            'batteryIssue' => $this->battery_issue,
            'batteryCurrentVoltage' => $this->battery_current_voltage,
            'batteryCycles' => $this->battery_cycles,
            'batteryCurrentCapacity' => $this->battery_current_capacity,
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at,
            'serial' => new SerialResource($this->return->serial),
            'item' => new ItemResource($this->return->item),
            'replacementItems' => $this->replacementItems,
            'order' => $this->order
        ];
    }
}
