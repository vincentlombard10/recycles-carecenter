<td class="p-2" style="width: 12rem;">
    <div class="mb-2">
        <div class="tinycard">
            <div><span class="fw-bold">Service</span></div>
        @if($item->assignation)
                <span>{{ $item->assignation }}</span>
            @else
                <span class="text-orange-500">Indisponible</span>
            @endif
        </div>
    </div>
    <div class="mb-2">
        <div class="tinycard">
            <div><span class="fw-bold">Action</span></div>
        @if($item->action)
                <span>{{ $item->action }}</span>
            @else
                <small class="text-orange-500">Indisponible</small>
            @endif
        </div>
    </div>
    <div class="mb-2">
        <div class="tinycard">
            <div><span class="fw-bold">Destination</span></div>
        @if($item->destination)
                <span>{{ $item->destination }}</span>
            @else
                <span class="text-orange-500">Indisponible</span>
            @endif
        </div>
    </div>
</td>
