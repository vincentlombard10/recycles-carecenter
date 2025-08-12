<td class="ps-4 pe-2 py-3">
    <div class="mb-2">
        <h4 class="fw-bold mb-1">{{ $report->identifier ?? 'IDENTIFIER' }}</h4>
        <div>{{ $report->return->from_code }} - {{ $report->return->from_name }}</div>
    </div>
    <div>
        <div><small>Créé le {{ date('d/m/Y', strtotime($report->created_at)) }} à {{ date('H:i', strtotime($report->created_at)) }}</small></div>
        <div><small>Dernière modification le {{ date('d/m/Y', strtotime($report->updated_at)) }} à {{ date('H:i', strtotime($report->updated_at)) }}</small></div>
    </div>
</td>
