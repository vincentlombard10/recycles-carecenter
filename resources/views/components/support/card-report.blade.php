@props(['report' => null])
<div class="Card_Support Card_Support--{{ $report->status }} rounded-lg">
    <div class="Card_Support--Body">
        <div class="Card_Support--Main mb-2">
            <div class="grid gap-1">
                <h2 class="fw-semibold mb-2">{{ $report->identifier }}</h2>
                @if($report->return->environment === \App\Models\ProductReturn::ENV_SANDBOX)
                    <div class="d-grid mb-1">
                        <span class="badge badge-{{ $report->return->environment }}">Sandbox</span>
                    </div>
                @endif
                <div class="d-grid mb-1">
                    <span class="badge">{{ $report->return->type_label }}</span>
                </div>
                <div class="d-grid mb-1">
                    <span class="badge">{{ $report->return->context_label }}</span>
                </div>
                <div class="d-grid mb-1">
                    <span class="badge">
                        <div>{{ $report->return->ticket_id }}</div>
                        @if($report->return->ticket?->contact)
                        <div><span class="text-primary">{{ $report->return->ticket?->contact->code }}</span></div>
                        @endif
                    </span>
                </div>
            </div>
            <div>
                @if($report->return->type === 'bike')
                    <x-card-bike :item="$report->return"/>
                @elseif($report->return->type === 'component')
                    <x-card-component :item="$report->return"/>
                @elseif($report->return->type === 'battery')
                    <x-card-battery :item="$report->return"/>
                @else
                    <div>Non défini</div>
                @endif
            </div>
            <div>
                <div class="px-3 py-2 bg-gray-100 text-xs rounded mb-2">
                    {{ $report->return->info ?? '-' }}
                </div>
                @if($report->return->note)
                <div class="px-3 py-2 bg-yellow-100 text-xs rounded mb-2">
                    {{ $report->return->note ?? '-' }}
                </div>
                @endif
                <div><small>Créé le {{ date('d/m/Y à H:i', strtotime($report->created_at)) }}
                        &nbsp;par&nbsp;<span
                            class="fw-semibold">{{ $report->return->author?->username }}</span></small>
                </div>
                @if($report->started_at)
                    <div><small>Expertise démarrée
                            le {{ date('d/m/Y à H:i', strtotime($report->started_at))}}
                            &nbsp;par&nbsp;<span
                                class="fw-semibold">{{ $report->technician?->username ?? '-' }}</span></small>
                    </div>
                @endif
                @if($report->closed_at)
                    <div><small>et terminée le {{ date('d/m/Y à H:i', strtotime($report->closed_at)) }}
                            .</small></div>
                @endif
                <div>
                    @foreach($report->estimates as $estimate)
                        <li>{{ $estimate->file }} - {{ $estimate->state }}</li>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="Card_Support--Side">
        <div class="d-grid gap-1">
                        <span
                            class="rcf-badge rcf-badge--{{ $report->status_color }}">{{ $report->status_label }}</span>
            @if(($report->isPending() || $report->isPaused() || $report->isInProgress()) && auth()->user()->can('reports.update'))
                <div class="btn-group">
                    <button type="button" class="btn btn-light dropdown-toggle"
                            data-bs-toggle="dropdown"
                            aria-expanded="false">
                        Actions
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        @if($report->isPending() || $report->isPaused())
                            <li>
                                <button class="dropdown-item text-end"
                                        popovertarget="po-{{ $report->id }}">
                                    {{ $report->isPaused() ? 'Reprendre' : 'Démarrer' }}
                                    <i class="bi bi-pencil-square ms-2"></i></button>
                            </li>
                        @endif
                        @if($report->isInProgress())
                            <li><a class="dropdown-item text-end"
                                   href="{{ route('support.reports.edit', $report->identifier) }}">
                                    Editer
                                    <i class="bi bi-pencil-square ms-2"></i></a></li>
                        @endif
                    </ul>
                </div>
            @elseif($report->isClosed())
                <div class="btn-group">
                    <button type="button" class="btn btn-light dropdown-toggle"
                            data-bs-toggle="dropdown"
                            aria-expanded="false">
                        Actions
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item text-end"
                               href="{{ route('support.reports.download', $report->identifier) }}">
                                Télécharger le rapport<i class="bi bi-download ms-2"></i></a></li>
                    </ul>
                </div>
            @endif
        </div>
    </div>
</div>
