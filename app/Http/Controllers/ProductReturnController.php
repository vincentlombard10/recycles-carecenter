<?php

namespace App\Http\Controllers;

use App\Helpers\AlphacodeHelper;
use App\Models\Contact;
use App\Models\Item;
use App\Models\ProductReturn;
use App\Models\Serial;
use App\Models\Ticket;
use Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Devrabiul\ToastMagic\Facades\ToastMagic;
use Exception;

class ProductReturnController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        if(!Auth::user()->can('returns.read')) {
            \ToastMagic::error('You do not have permission to access this page.');
            return redirect()->route('dashboard');
        }

        $returns_count = ProductReturn::count();
        return view('returns.index', compact('returns_count'));
    }

    public function create()
    {
        if(!Auth::user()->can('returns.create')) {
            \ToastMagic::error('You do not have permission to access this page.');
            return redirect()->route('dashboard');
        }
        if (!auth()->user()->hasAnyPermission('returns.create')) {
            return redirect()->back()->with('message', 'You are not authorized to use this functionality!');
        }

        return view('returns.create');

    }

    public function store(Request $request): RedirectResponse
    {
        $qualification = self::getQualification(
            type: $request->type ?? null,
            context: $request->context ?? null,
            reason: $request->reason ?? null,
            assignation: $request->assignation ?? null,
            action: $request->action ?? null,
            destination: $request->destination ?? null
        );
        $ticket = self::getTicket(ticket: $request->ticket);
        $item = self::getItem(item: $request->item);
        $serial = self::getSerial(
            code: $request->serial_code ?? null,
            designation: $request->serial_itds ?? null,
            sku: $request->serial_itno ?? null,
            brand: $request->serial_itcl ?? null,
        );
        $salesInformation = self::getSalesInformation(
            date: $request->bike_sold_at ?? null,
            order: $request->order ?? null,
            invoice: $request->invoice ?? null,
            delivery: $request->delivery ?? null,
        );
        $comments = self::getComments(
            info: $request->info ?? null,
            note: $request->note ?? null
        );
        $sender = self::getSender(
            prefix: 'routing_from_',
            code: $request->routing_from_code ?? null,
            address1: $request->routing_from_address1 ?? null,
            address2: $request->routing_from_address2 ?? null,
            postcode: $request->routing_from_postcode ?? null,
            city: $request->routing_from_city ?? null,
        );
        $recipient = self::getRecipient(
            prefix: 'routing_to_',
            code: $request->routing_to_code ?? null,
            address1: $request->routing_to_address1 ?? null,
            address2: $request->routing_to_address2 ?? null,
            postcode: $request->routing_to_postcode ?? null,
            city: $request->routing_to_city ?? null,
        );
        $returnTo = self::getReturnedTo(
            prefix: 'return_to_',
            code: $request->return_to_code ?? null,
            address1: $request->return_to_address ?? null,
            address2: $request->return_to_address ?? null,
            postcode: $request->return_to_postcode ?? null,
            city: $request->return_to_city ?? null,
        );
        $data = [...$qualification, ...$ticket, ...$item, ...$serial, ...$salesInformation, ...$comments, ...$sender, ...$recipient, ...$returnTo];
        try {
            $return = ProductReturn::create([
                'identifier' => AlphacodeHelper::generateCode(6),
                ...$data,
                'author_id' => auth()->user()->id,
                'status' => $request->status ?? ProductReturn::STATUS_INCOMPLETE,
            ]);

            if ($request->ticket) {
                $return->ticket()->associate(Ticket::findOrFail($request->ticket));
                $return->save();
            }

            ToastMagic::info(sprintf("Le retour produit %s a bien été créé.", $return->identifier));

        } catch (Exception $exception) {

            dd($exception->getMessage());

        }

        return redirect()->route('support.returns.index');

    }

    public function show($id)
    {
        if(!Auth::user()->can('returns.read')) {
            \ToastMagic::error('You do not have permission to access this page.');
            return redirect()->route('dashboard');
        }
        if (!auth()->user()->hasAnyPermission('returns.read')) {
            return redirect()->back()->with('message', 'You are not authorized to use this functionality!');
        }

        $productReturn = ProductReturn::where('identifier', $id)->first();
        return view('returns.show', compact('productReturn'));
    }

    public function edit($identifier)
    {
        if(!Auth::user()->can('returns.update')) {
            \ToastMagic::error('You do not have permission to access this page.');
            return redirect()->route('dashboard');
        }

        $return = ProductReturn::where('identifier', $identifier)->withTrashed()->firstOrFail();
        return view('returns.edit', compact('return'));
    }

    public function update(Request $request, $id)
    {
        $qualification = self::getQualification(
            type: $request->type ?? null,
            context: $request->context ?? null,
            reason: $request->reason ?? null,
            assignation: $request->assignation ?? null,
            action: $request->action ?? null,
            destination: $request->destination ?? null
        );
        $ticket = self::getTicket(ticket: $request->ticket);
        $item = self::getItem(item: $request->item);
        $serial = self::getSerial(
            code: $request->serial_code ?? null,
            designation: $request->serial_itds ?? null,
            sku: $request->serial_itno ?? null,
            brand: $request->serial_itcl ?? null,
        );
        $salesInformation = self::getSalesInformation(
            date: $request->bike_sold_at ?? null,
            order: $request->order ?? null,
            invoice: $request->invoice ?? null,
            delivery: $request->delivery ?? null,
        );
        $comments = self::getComments(
            info: $request->info ?? null,
            note: $request->note ?? null
        );
        $sender = self::getSender(
            prefix: 'routing_from_',
            code: $request->routing_from_code ?? null,
            address1: $request->routing_from_address1 ?? null,
            address2: $request->routing_from_address2 ?? null,
            postcode: $request->routing_from_postcode ?? null,
            city: $request->routing_from_city ?? null,
        );
        $recipient = self::getRecipient(
            prefix: 'routing_to_',
            code: $request->routing_to_code ?? null,
            address1: $request->routing_to_address1 ?? null,
            address2: $request->routing_to_address2 ?? null,
            postcode: $request->routing_to_postcode ?? null,
            city: $request->routing_to_city ?? null,
        );
        $reshippedTo = self::getReturnedTo(
            prefix: 'return_to_',
            code: $request->return_to_code ?? null,
            address1: $request->return_to_address1 ?? null,
            address2: $request->return_to_address2 ?? null,
            postcode: $request->return_to_postcode ?? null,
            city: $request->return_to_city ?? null,
        );
        $data = [
            ...$qualification,
            ...$ticket,
            ...$item,
            ...$serial,
            ...$salesInformation,
            ...$comments,
            ...$sender,
            ...$recipient,
            ...$reshippedTo,
            'status' => $request->status,
        ];
        $productReturn = ProductReturn::find($id);
        $productReturn->update($data);
        return redirect()->route('support.returns.index');
    }

    public function updateReception(Request $request, $id)
    {
        if(!Auth::user()->can('returns.update')) {
            \ToastMagic::error('You do not have permission to access this page.');
            return redirect()->route('support.returns.index');
        }
        try {
            $productReturn = ProductReturn::findOrFail($id);
            if (!$productReturn->received_at) {
                $productReturn->update([
                    'status' => ProductReturn::STATUS_RECEIVED,
                    'received_at' => now(),
                ]);
                $productReturn->report->update([
                    'status' => ProductReturn::STATUS_PENDING,
                ]);
            }
            return redirect()->route('support.returns.index');
        } catch (Exception $exception) {
            dd($exception->getMessage());
        }
    }

    public function destroy(Request $request, $id)
    {
        if (!auth()->user()->hasAnyPermission('returns.delete')) {
            return redirect()->back()->with('message', 'You are not authorized to use this functionality!');
        }

        $productReturn = ProductReturn::find($id);
        $productReturn->report?->delete();
        $productReturn->delete();
        ToastMagic::info(sprintf("Le retour produit %s a bien été archivé.", $productReturn->identifier));
        return redirect()->route('support.returns.index');
    }

    public function trash()
    {
        if (!auth()->user()->hasAnyPermission('returns.read')) {
            return redirect()->back()->with('message', 'You are not authorized to use this functionality!');
        }

        return view('returns.archives');
    }

    public function forceDelete($id)
    {
        $productReturn = ProductReturn::withTrashed()->find($id);
        $productReturn->report?->forceDelete();
        $productReturn->forceDelete();
        ToastMagic::error(sprintf("Le retour produit %s est définitivement supprimé.", $productReturn->identifier));
        return redirect()->route('support.returns.trash');
    }

    public function restore($id)
    {
        $productReturn = ProductReturn::withTrashed()->where('identifier', $id)->first();
        $productReturn->report?->restore();
        $productReturn->restore();
        ToastMagic::info(sprintf("Le retour produit %s a bien été restauré.", $productReturn->identifier));
        return redirect()->route('support.returns.index');
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
