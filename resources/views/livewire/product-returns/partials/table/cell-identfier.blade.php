<td class="p-2" style="width: 12rem;">
    <h4 class="fw-bold">{{ $item->identifier ?? 'IDENTIFIER' }}</h4>
    <div class="d-grid mb-1"><span class="badge">{{ $item->type }}</span></div>
    <div class="d-grid mb-1"><span class="badge">{{ $item->context }}</span></div>
    <div class="d-grid"><span class="badge">{{ $item->ticket?->id }}</span></div>
</td>
