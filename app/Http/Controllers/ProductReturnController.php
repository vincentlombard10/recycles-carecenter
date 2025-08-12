<?php

namespace App\Http\Controllers;

use App\Helpers\AlphacodeHelper;
use App\Models\Contact;
use App\Models\Item;
use App\Models\ProductReturn;
use App\Models\Serial;
use App\Models\Ticket;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Devrabiul\ToastMagic\Facades\ToastMagic;
use Exception;

class ProductReturnController extends Controller
{
    public function index()
    {
        $returns_count = ProductReturn::count();
        return view('returns.index', compact('returns_count'));
    }

    public function create()
    {
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
                'from_id' => Contact::where('code', $request->input('from-code'))->first()->id ?? null,
                'from_code' => $request->input('from-code'),
                'from_name' => $request->input('from-name'),
                'from_address1' => $request->input('from-address1'),
                'from_address2' => $request->input('from-address2'),
                'from_postalcode' => $request->input('from-postalcode'),
                'from_city' => $request->input('from-city'),

                'to_id' => Contact::where('code', $request->input('to-code'))->first()->id ?? null,
                'to_code' => $request->input('to-code'),
                'to_name' => $request->input('to-name'),
                'to_address1' => $request->input('to-address1'),
                'to_address2' => $request->input('to-address2'),
                'to_postalcode' => $request->input('to-postalcode'),
                'to_city' => $request->input('to-city'),

                'reshipment_id' => Contact::where('code', $request->input('reshipment-code'))->first()->id ?? null,
                'reshipment_code' => $request->input('reshipment-code'),
                'reshipment_name' => $request->input('reshipment-name'),
                'reshipment_address1' => $request->input('reshipment-address1'),
                'reshipment_address2' => $request->input('reshipment-address2'),
                'reshipment_postalcode' => $request->input('reshipment-postalcode'),
                'reshipment_city' => $request->input('reshipment-city'),

                'author_id' => 1,
            ]);

            if ($request->ticket) {

                $return->ticket()->associate(Ticket::findOrFail($request->ticket));
                $return->save();

            }

        } catch (Exception $exception) {

            dd($exception->getMessage());

        }

        return redirect()->route('support.returns.index');

    }

    public function show($id)
    {
        $productReturn = ProductReturn::where('identifier', $id)->first();
        return view('returns.show', compact('productReturn'));
    }

    public function edit($identifier)
    {
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
        $productReturn = ProductReturn::find($id);
        $productReturn->report->delete();
        $productReturn->delete();
        $message = sprintf("Retour produit %s déplacé dans la <a href=%s>corbeille</a>.", $productReturn->identifier, route('support.returns.trash'));
        ToastMagic::info(sprintf("Le retour produit %s a bien été archivé.", $productReturn->identifier));
        return redirect()->route('support.returns.index', $productReturn->id)->with('success', $message);
    }

    public function trash()
    {
        return view('returns.archives');
    }

    public function forceDelete($id)
    {
        $productReturn = ProductReturn::withTrashed()->find($id);
        $productReturn->report->forceDelete();
        $productReturn->forceDelete();
        ToastMagic::error(sprintf("Le retour produit %s est définitivement suprimé.", $productReturn->identifier));
        return redirect()->route('support.returns.trash');
    }

    public function restore($id)
    {
        $productReturn = ProductReturn::withTrashed()->find($id);
        $productReturn->report->restore();
        $productReturn->restore();
        ToastMagic::info(sprintf("Le retour produit %s a bien été restauré.", $productReturn->identifier));
        return redirect()->route('support.returns.index');
    }
}
