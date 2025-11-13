<?php

namespace App\Http\Controllers;

use App\Helpers\AlphacodeHelper;
use App\Models\Contact;
use App\Models\Item;
use App\Models\ProductReturn;
use App\Models\Serial;
use App\Models\Ticket;
use App\Services\ProductReturnService;
use Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Devrabiul\ToastMagic\Facades\ToastMagic;
use Exception;

class ProductReturnController extends Controller
{
    protected ProductReturnService $productReturnService;

    public function __construct(ProductReturnService $productReturnService)
    {
        $this->productReturnService = $productReturnService;
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
        $qualificationData = [
            'type' => $request->type ?? null,
            'context' => $request->context ?? null,
            'reason' => $request->reason ?? null,
            'assignation' => $request->assignation ?? null,
            'action' => $request->action ?? null,
            'destination' => $request->destination ?? null
        ];
        $ticketData = ['ticket' => $request->ticket ?? null];
        $itemData = ['item' => $request->item ?? null];
        $serialData = [
            'serial_code' => $request->serial_code ?? null,
            'serial_itds' => $request->serial_itds ?? null,
            'serial_itno' => $request->serial_itno ?? null,
            'serial_itcl' => $request->serial_itcl ?? null,
            'serial_id' => Serial::where('code', $request->serial_code)->first()->id ?? null,
        ];
        $salesData = [
            'date' => $request->bike_sold_at ?? null,
            'order' => $request->order ?? null,
            'invoice' => $request->invoice ?? null,
            'delivery' => $request->delivery ?? null,
        ];
        $commentsData = [
            'info' => $request->info ?? null,
            'note' => $request->note ?? null,
        ];
        $senderData = [
            'routing_from_code' => $request->routing_from_code ?? null,
            'routing_from_address1' => $request->routing_from_address1 ?? null,
            'routing_from_address2' => $request->routing_from_address2 ?? null,
            'routing_from_postcode' => $request->routing_from_postcode ?? null,
            'routing_from_city' => $request->routing_from_city ?? null,
        ];
        $recipientData = [
            'routing_to_code' => $request->routing_to_code ?? null,
            'routing_to_address1' => $request->routing_to_address1 ?? null,
            'routing_to_address2' => $request->routing_to_address2 ?? null,
            'routing_to_postcode' => $request->routing_to_postcode ?? null,
            'routing_to_city' => $request->routing_to_city ?? null,
        ];
        $returnToData = [
            'return_to_code' => $request->return_to_code ?? null,
            'return_to_address1' => $request->return_to_address1 ?? null,
            'return_to_address2' => $request->return_to_address2 ?? null,
            'return_to_postcode' => $request->return_to_postcode ?? null,
            'return_to_city' => $request->return_to_city ?? null,
        ];
        $data = [
            ...$qualificationData,
            ...$ticketData,
            ...$itemData,
            ...$serialData,
            ...$salesData,
            ...$commentsData,
            ...$senderData,
            ...$recipientData,
            ...$returnToData,
            'environment' => $request->environment ?? 'sandbox',
        ];


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
        if(!auth()->user()->hasAnyPermission('returns.read')) {

            \ToastMagic::error('You do not have permission to access this page.');
            return redirect()->route('dashboard');

        }

        return view('returns.show')
            ->with('productReturn', ProductReturn::where('identifier', $id)->first());
    }

    public function edit($identifier)
    {
        if(!Auth::user()->can('returns.update')) {
            \ToastMagic::error('You do not have permission to access this page.');
            return redirect()->route('dashboard');
        }

        return view('returns.edit')
            ->with('return', ProductReturn::where('identifier', $identifier)->firstOrFail());
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
            phone: $request->routing_from_phone ?? null,
            email: $request->routing_from_email ?? null,
            info: $request->routing_from_info ?? null,
        );
        $recipient = self::getRecipient(
            prefix: 'routing_to_',
            code: $request->routing_to_code ?? null,
            address1: $request->routing_to_address1 ?? null,
            address2: $request->routing_to_address2 ?? null,
            postcode: $request->routing_to_postcode ?? null,
            city: $request->routing_to_city ?? null,
            phone: $request->routing_to_phone ?? null,
            email: $request->routing_to_email ?? null,
            info: $request->routing_to_info ?? null,
        );
        $reshippedTo = self::getReturnedTo(
            prefix: 'return_to_',
            code: $request->return_to_code ?? null,
            address1: $request->return_to_address1 ?? null,
            address2: $request->return_to_address2 ?? null,
            postcode: $request->return_to_postcode ?? null,
            city: $request->return_to_city ?? null,
            phone: $request->return_to_phone ?? null,
            email: $request->return_to_email ?? null,
            info: $request->return_to_info ?? null,
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
                    'receiver_id' => auth()->user()->id,
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
        string|null $city,
        string|null $phone,
        string|null $email,
        string|null $info,
    ): array
    {
        return [
            $prefix . 'id' => Contact::where('code', $code)->first()->id ?? null,
            $prefix . 'code' => $code ? trim($code) : null,
            $prefix . 'address1' => $address1 ? trim($address1) : null,
            $prefix . 'address2' => $address2 ? trim($address2) : null,
            $prefix . 'postcode' => $postcode ? trim($postcode) : null,
            $prefix . 'city' => $city ? trim($city) : null,
            $prefix . 'phone' => $phone ? trim($phone) : null,
            $prefix . 'email' => $email ? trim($email) : null,
            $prefix . 'info' => $info ? trim($info) : null,
        ];
    }

    private function getRecipient(
        string|null $prefix,
        string|null $code,
        string|null $address1,
        string|null $address2,
        string|null $postcode,
        string|null $city,
        string|null $phone,
        string|null $email,
        string|null $info,
    ): array
    {
        return [
            $prefix . 'id' => Contact::where('code', $code)->first()->id ?? null,
            $prefix . 'code' => $code ? trim($code) : null,
            $prefix . 'address1' => $address1 ? trim($address1) : null,
            $prefix . 'address2' => $address2 ? trim($address2) : null,
            $prefix . 'postcode' => $postcode ? trim($postcode) : null,
            $prefix . 'city' => $city ? trim($city) : null,
            $prefix . 'phone' => $phone ? trim($phone) : null,
            $prefix . 'email' => $email ? trim($email) : null,
            $prefix . 'info' => $info ? trim($info) : null,
        ];
    }

    private function getReturnedTo(
        string|null $prefix,
        string|null $code,
        string|null $address1,
        string|null $address2,
        string|null $postcode,
        string|null $city,
        string|null $phone,
        string|null $email,
        string|null $info,
    ): array
    {
        return [
            $prefix . 'id' => Contact::where('code', $code)->first()->id ?? null,
            $prefix . 'code' => $code ? trim($code) : null,
            $prefix . 'address1' => $address1 ? trim($address1) : null,
            $prefix . 'address2' => $address2 ? trim($address2) : null,
            $prefix . 'postcode' => $postcode ? trim($postcode) : null,
            $prefix . 'city' => $city ? trim($city) : null,
            $prefix . 'phone' => $phone ? trim($phone) : null,
            $prefix . 'email' => $email ? trim($email) : null,
            $prefix . 'info' => $info ? trim($info) : null,
        ];
    }
}
