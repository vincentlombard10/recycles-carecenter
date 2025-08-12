<td class="p-2">
    <div class="tinycard">
        <div><span class="fw-bold">Raison</span></div>
        @if($item->reason)
            <span>{{ $item->reason }}</span>
        @else
            <span class="text-orange-500">Indisponible</span>
        @endif
    </div>
</td>
