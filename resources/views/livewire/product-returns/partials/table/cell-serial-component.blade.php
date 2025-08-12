<td class="p-2">
    <div class="mb-2">
        @if($item->ofTypeComponent())
            <div class="tinycard tinycard--lg">
                <div><span class="fw-bold">{{ $item->item_itno  }}</span></div>
                <div><small>{{ $item->item?->itds  }}</small></div>
                <div><small>{{ $item->item?->brand->code  }}</small></div>
            </div>
        @elseif($item->ofTypeBike())
            <div class="tinycard tinycard--lg">
                <div><span class="fw-bold">{{ $item->serial_code  }}</span></div>
                <div><small>{{ $item->serial->item->itno  }}</small></div>
                <div><small>{{ $item->serial->item->brand->code  }}</small></div>
            </div>
        @else
            <span>Indisponible</span>
        @endif
    </div>
    <div class="tinycard">
        <div><small class="fw-bold">Raison</small></div>
        @if($item->reason)
            <span>{{ $item->reason }}</span>
        @else
            <small class="text-orange-500">Indisponible</small>
        @endif
    </div>
</td>
