<?php

namespace App\Services;

use App\Models\Contact;
use App\Models\Item;
use App\Models\ProductReturn;
use App\Models\Serial;

class ProductReturnService
{
    public function createProductReturn(array $data): ProductReturn
    {

    }

    private function getQualification(
        string|null $type,
        string|null $context,
        string|null $reason,
        string|null $assignation,
        string|null $action,
        string|null $destination
    ): array
    {
        return [
            'type' => $type,
            'context' => $context,
            'reason' => $reason,
            'assignation' => $assignation,
            'action' => $action,
            'destination' => $destination
        ];
    }

    private function getTicket(string|null $ticket): array
    {
        return [
            'ticket_id' => $ticket ?? null,
        ];
    }

    private function getItem(string|null $item): array
    {
        return [
            'item_id' => Item::where('itno', $item)->first()->id ?? null,
            'item_itno' => $item ?? null,
        ];
    }

    private function getSerial(
        string|null $code,
        string|null $designation,
        string|null $sku,
        string|null $brand): array
    {
        return [
            'serial_code' => $code,
            'serial_itno' => $sku,
            'serial_itds' => $designation,
            'serial_ictl' => $brand,
            'serial_id' => Serial::where('code', $code)->first()->id ?? null,
        ];
    }

    private function getSalesInformation(
        string|null $date,
        string|null $order,
        string|null $invoice,
        string|null $delivery,
    ): array
    {
        return [
            'bike_sold_at' => $date,
            'order' => $order,
            'invoice' => $invoice,
            'delivery' => $delivery
        ];
    }

    private function getComments(string|null $info, string|null $note): array
    {
        return [
            'info' => $info ? trim($info) : null,
            'note' => $note ? trim($note) : null,
        ];
    }

    private function getSender(
        string|null $prefix,
        string|null $code,
        string|null $address1,
        string|null $address2,
        string|null $postcode,
        string|null $city
    ): array
    {
        return [
            $prefix . 'id' => Contact::where('code', $code)->first()->id ?? null,
            $prefix . 'code' => $code ? trim($code) : null,
            $prefix . 'address1' => $address1 ? trim($address1) : null,
            $prefix . 'address2' => $address2 ? trim($address2) : null,
            $prefix . 'postcode' => $postcode ? trim($postcode) : null,
            $prefix . 'city' => $city ? trim($city) : null,
        ];
    }

    private function getRecipient(
        string|null $prefix,
        string|null $code,
        string|null $address1,
        string|null $address2,
        string|null $postcode,
        string|null $city
    ): array
    {
        return [
            $prefix . 'id' => Contact::where('code', $code)->first()->id ?? null,
            $prefix . 'code' => $code ? trim($code) : null,
            $prefix . 'address1' => $address1 ? trim($address1) : null,
            $prefix . 'address2' => $address2 ? trim($address2) : null,
            $prefix . 'postcode' => $postcode ? trim($postcode) : null,
            $prefix . 'city' => $city ? trim($city) : null,
        ];
    }

    private function getReturnedTo(
        string|null $prefix,
        string|null $code,
        string|null $address1,
        string|null $address2,
        string|null $postcode,
        string|null $city
    ): array
    {
        return [
            $prefix . 'id' => Contact::where('code', $code)->first()->id ?? null,
            $prefix . 'code' => $code ? trim($code) : null,
            $prefix . 'address1' => $address1 ? trim($address1) : null,
            $prefix . 'address2' => $address2 ? trim($address2) : null,
            $prefix . 'postcode' => $postcode ? trim($postcode) : null,
            $prefix . 'city' => $city ? trim($city) : null,
        ];
    }
}
