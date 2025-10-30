<td class="ps-4 pe-2 py-3">
    <div class="mb-2">
        <h2 class="fw-semibold mb-1">{{ $report->identifier ?? 'IDENTIFIER' }}</h2>
        <div>{{ $report->return->type }}</div>
        <div>{{ $report->return->routing_from_code }}</div>
        <div>{{ $report->return->routing_to_code }}</div>
        <div>{{ $report->return->return_to_code }}</div>
    </div>
    <div>
        <div><small>Créé le {{ date('d/m/Y', strtotime($report->created_at)) }} à {{ date('H:i', strtotime($report->created_at)) }}</small></div>
        <div><small>Dernière modification le {{ date('d/m/Y', strtotime($report->updated_at)) }} à {{ date('H:i', strtotime($report->updated_at)) }}</small></div>
    </div>
</td>
