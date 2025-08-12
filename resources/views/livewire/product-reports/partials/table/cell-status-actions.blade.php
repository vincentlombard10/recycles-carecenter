<td class="ps-2 pe-4 py-3" style="width: 10rem;">
    <div class="d-grid gap-2">
        <span class="badge status--{{ $report->status_color }}">{{ $report->status_label }}</span>
        <div class="btn-group">
            <button type="button" class="btn btn-sm btn-outline-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                Actions
            </button>
            <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="{{ route('support.reports.edit', $report->identifier) }}">Editer</a></li>
                <li><a class="dropdown-item" href="{{ route('support.reports.edit', $report->identifier) }}">Télécharger le rapport</a></li>
            </ul>
        </div>
    </div>
</td>
