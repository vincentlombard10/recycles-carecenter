<td class="p-2" style="width: 12rem;">
    <div class="mb-2">
        <div class="tinycard">
            <div><span  class="fw-bold">Commande</span></div>
            @if($item->order)
                <span>{{ $item->order }}</span>
            @else
                <span class="text-orange-500">Indisponible</span>
            @endif
        </div>
    </div>
    <div class="mb-2">
        <div class="tinycard">
            <div><span class="fw-bold">Facture</span></div>
            @if($item->invoice)
                <span>{{ $item->invoice }}</span>
            @else
                <span class="text-orange-500">Indisponible</span>
            @endif
        </div>
    </div>
    <div class="mb-2">
        <div class="tinycard">
            <div><span class="fw-bold">Livraison</span></div>
            @if($item->delivery)
                <span>{{ $item->delivery }}</span>
            @else
                <span class="text-orange-500">Indisponible</span>
            @endif
        </div>
    </div>
</td>
