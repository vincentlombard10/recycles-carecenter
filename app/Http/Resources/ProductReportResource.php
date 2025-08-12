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
            'status' => $this->status,
            'type' => $this->type,
            'reason' => $this->reason,
            'comment' => $this->comment,
            'batteryKey' => $this->battery_key,
            'antitheftKey' => $this->antitheft_key,
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
            'stripes' => $this->stripes,
            'corrosion' => $this->corrosion,
            'clay' => $this->clay,
            'sand' => $this->sand,
            'impacts' => $this->impacts,
            'cracks' => $this->cracks,
            'breakages' => $this->breakages,
            'customizations' => $this->customizations,
            'checkComment' => $this->check_comment,
            'issueComment' => $this->issue_comment,
            'batteryReference' => $this->battery_reference,
            'batterySerial' => $this->battery_serial,
            'batteryType' => $this->battery_type,
            'batteryVoltage' => $this->battery_voltage,
            'batteryCapacity' => $this->battery_capacity,
            'batteryLook' => $this->battery_look,
            'batteryCharge' => $this->battery_charge,
            'batteryIssue' => $this->battery_issue,
            'batteryCurrentVoltage' => $this->battery_current_voltage,
            'batteryEnergy' => $this->battery_energy,
            'batteryCycles' => $this->battery_cycles,
            'batteryCellsState' => $this->battery_cells_state,
            'batteryCurrentCapacity' => $this->battery_current_capacity,
            'batteryTemperature' => $this->battery_temperature,
            'batteryInternalResistance' => $this->battery_internal_resistance,
            'diagnostic' => $this->diagnostic,
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at,
            'serial' => new SerialResource($this->return->serial),
            'item' => new ItemResource($this->return->item),
        ];
    }
}
