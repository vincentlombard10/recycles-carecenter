<td class="py-4">
    <div class="mb-2">
        <div><small  class="fw-bold">Expéditeur</small></div>
        <div>{{ $item->from_code }} - {{ $item->from_postalcode }} {{ $item->from_city }}</div>
    </div>
    <div class="mb-2">
        <div><small class="fw-bold">Destinataire</small></div>
        <div>{{ $item->to_code }}  - {{ $item->to_postalcode }} {{ $item->to_city }}</div>
    </div>
    <div class="mb-2">
        <div><small class="fw-bold">Réexpédition</small></div>
        <div>{{ $item->reshipment_code }}  - {{ $item->reshipment_postalcode }} {{ $item->reshipment_city }}</div>
    </div>
</td>
