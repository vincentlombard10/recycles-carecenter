<td class="py-4">
    <div class="mb-2">
        <div><small  class="fw-bold">Expéditeur</small></div>
        <div>{{ $item->from_code }} - {{ $item->from_postcode }} {{ $item->from_city }}</div>
    </div>
    <div class="mb-2">
        <div><small class="fw-bold">Destinataire</small></div>
        <div>{{ $item->to_code }}  - {{ $item->to_postcode }} {{ $item->to_city }}</div>
    </div>
    <div class="mb-2">
        <div><small class="fw-bold">Réexpédition</small></div>
        <div>{{ $item->return_to_code }}  - {{ $item->return_to_postcode }} {{ $item->return_to_city }}</div>
    </div>
</td>
