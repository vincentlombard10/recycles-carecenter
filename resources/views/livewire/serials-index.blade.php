<div class="mx-auto max-w-[1200px]">
    <x-pagination :items="$serials" class="mb-3"/>
    <table class="table-auto bg-white w-full mb-3">
        <thead class="bg-violet-900 text-white py-2">
        <tr>
            <th class="w-[6rem] py-1 text-xs">Code</th>
            <th class="w-[10rem] py-1 text-xs">SKU</th>
            <th class="text-xs text-left">Designation</th>
            <th class="w-[6rem] py-1 text-xs">Client</th>
            <th class="w-[6rem] py-1 text-xs">Commande</th>
            <th class="w-[6rem] py-1 text-xs">BL</th>
            <th class="w-[6rem] py-1 text-xs">Out</th>
            <th class="w-[8rem] py-1 text-xs">Facture</th>
        </tr>
        </thead>
        <tbody>
        @foreach($serials as $serial)
            <tr class="border-b-slate-300 border-b-1 hover:bg-orange-100">
                <td class="px-3 py-2">{{ $serial->code  }}</td>
                <td class="px-3 py-2">
                    @if($serial->item)
                        <span class="fw-semibold text-primary">{{ $serial->item->itno }}</span>
                    @else
                        <span>{{ $serial->item_itno  }}</span>
                    @endif
                </td>
                <td class="px-3 py-2">
                    @if($serial->item)
                        <span class="">{{ $serial->item->itds }}</span>
                    @endif
                </td>
                <td class="px-3 py-2">{{ $serial->dealer_code  }}</td>
                <td class="px-3 py-2">{{ $serial->last_order  }}</td>
                <td class="px-3 py-2">{{ $serial->last_delivery  }}</td>
                <td class="px-3 py-2">{{ date('d/m/Y', $serial->out) }}</td>
                <td class="px-3 py-2">{{ $serial->last_invoice  }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <x-pagination :items="$serials" />
</div>
