<td class="ps-2 pe-4 py-3" style="width: 10rem;">
    <div class="d-grid gap-2">
        <span class="rcf-badge rcf-badge--{{ $report->status_color }}">{{ $report->status_label }}</span>
        @if($report->status !== 'init')
            <div class="btn-group">
                <button type="button" class="btn btn-sm btn-outline-dark dropdown-toggle" data-bs-toggle="dropdown"
                        aria-expanded="false">
                    Actions
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    @if($report->isPending())
                        <li><button class="dropdown-item text-end" popovertarget="po-{{ $report->id }}">Démarrer<i class="bi bi-pencil-square ms-2"></i></button></li>
                    @endif
                    @if($report->isInProgress())
                        <li><a class="dropdown-item" href="{{ route('support.reports.edit', $report->identifier) }}">Editer</a></li>
                    @endif
                    @if($report->status === 'closed')
                        <li><a class="dropdown-item" href="{{ route('support.reports.download', $report->identifier) }}">Télécharger
                                le rapport</a></li>
                    @endif
                </ul>
            </div>
        @endif
    </div>
</td>
