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
        if (!auth()->user()->hasAnyPermission('returns.read')) {
            return redirect()->back()->with('message', 'You are not authorized to use this functionality!');
        }

        $returns_count = ProductReturn::count();
        return view('returns.index', compact('returns_count'));
    }

    public function create()
    {
        if (!auth()->user()->hasAnyPermission('returns.create')) {
            return redirect()->back()->with('message', 'You are not authorized to use this functionality!');
        }

        return view('returns.create');

    }

    public function store(Request $request): RedirectResponse
    {

        try {
            $return = ProductReturn::create([
                // Section 1 - Qualification
                'identifier' => AlphacodeHelper::generateCode(6),
                'type' => $request->type,
                'context' => $request->context,
                'reason' => $request->reason,
                'assignation' => $request->assignee,
                'action' => $request->action,
                'destination' => $request->destination,

                // Section 3 - Produit (vélo / composant)
                'serial_code' => $request->serial ? $request->serial : null,
                'item_itno' => $request->component ? $request->component : null,
                'serial_id' => $request->serial ? Serial::where('code', $request->serial)->first()->id : null,
                'item_id' => $request->component ? Item::where('itno', $request->component)->first()->id : null,

                // Section 4 - Informations de vente
                'bike_sold_at' => $request->bike_sold_at,
                'order' => $request->order,
                'invoice' => $request->invoice,
                'delivery' => $request->delivery,

                // Section Sans validation // Commentaires
                'info' => $request->info,
                'comment' => $request->comment,

                // Section 5 - Adresses de cheminement du colis
                'routing_from_id' => Contact::where('code', $request->input('routing-from-code'))->first()->id ?? null,
                'routing_from_code' => $request->input('routing-from-code'),
                'routing_from_name' => $request->input('routing-from-name'),
                'routing_from_address1' => $request->input('routing-from-address1'),
                'routing_from_address2' => $request->input('routing-from-address2'),
                'routing_from_postalcode' => $request->input('routing-from-postalcode'),
                'routing_from_city' => $request->input('routing-from-city'),

                'routing_to_id' => Contact::where('code', $request->input('routing-to-code'))->first()->id ?? null,
                'routing_to_code' => $request->input('routing-to-code'),
                'routing_to_name' => $request->input('routing-to-name'),
                'routing_to_address1' => $request->input('routing-to-address1'),
                'routing_to_address2' => $request->input('routing-to-address2'),
                'routing_to_postalcode' => $request->input('routing-to-postalcode'),
                'routing_to_city' => $request->input('routing-to-city'),

                'return_id' => Contact::where('code', $request->input('return-code'))->first()->id ?? null,
                'return_code' => $request->input('return-code'),
                'return_name' => $request->input('return-name'),
                'return_address1' => $request->input('return-address1'),
                'return_address2' => $request->input('return-address2'),
                'return_postalcode' => $request->input('return-postalcode'),
                'return_city' => $request->input('return-city'),

                'author_id' => 1,
                'status' => ProductReturn::STATUS_PENDING,

            ]);

            if ($request->ticket) {

                $return->ticket()->associate(Ticket::findOrFail($request->ticket));
                $return->save();
            }

            ToastMagic::info(sprintf("Le retour produit %s a bien été archivé.", $return->identifier));

        } catch (Exception $exception) {

            dd($exception->getMessage());

        }

        return redirect()->route('support.returns.index');

    }

    public function show($id)
    {
        if (!auth()->user()->hasAnyPermission('returns.read')) {
            return redirect()->back()->with('message', 'You are not authorized to use this functionality!');
        }

        $productReturn = ProductReturn::where('identifier', $id)->first();
        return view('returns.show', compact('productReturn'));
    }

    public function edit($identifier)
    {
        if (!auth()->user()->hasAnyPermission('returns.update')) {
            return redirect()->back()->with('message', 'You are not authorized to use this functionality!');
        }

        $return = ProductReturn::where('identifier', $identifier)->withTrashed()->firstOrFail();
        return view('returns.edit', compact('return'));
    }

    public function update(Request $request, $id)
    {
        $productReturn = ProductReturn::find($id);
        $productReturn->update($request->except('_token', '_method'));
        return redirect()->route('support.returns.index');
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
        return redirect()->route('support.returns.index', $productReturn->id)->with('success', $message);
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
}
