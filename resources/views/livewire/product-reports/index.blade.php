<div>
    @if(count($reports))
        @foreach($reports as $report)
            <div class="Card_Support Card_Support--{{ $report->status }}">
                <div class="Card_Support--Body">
                    <div class="Card_Support--Main mb-2">
                        <div>
                            <h2 class="fw-semibold">{{ $report->identifier }}</h2>
                            <div class="d-grid mb-1">
                                <span class="badge">{{ $report->return->type_label }}</span>
                            </div>
                            <div class="d-grid mb-1">
                                <span class="badge">{{ $report->return->context_label }}</span>
                            </div>
                            <div class="d-grid mb-1">
                                <span class="badge">{{ $report->return->ticket_id }}</span>
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
                            <div><small>Créé le {{ date('d/m/Y à H:i', strtotime($report->created_at)) }}
                                    &nbsp;|&nbsp;<span
                                        class="fw-semibold">{{ $report->return->author?->username }}</span></small>
                            </div>
                            @if($report->started_at)
                                <div><small>Expertise démarrée
                                        le {{ date('d/m/Y à H:i', strtotime($report->started_at))}}&nbsp;|&nbsp;<span
                                            class="fw-semibold">{{ $report->technician?->username ?? '-' }}</span></small>
                                </div>
                            @endif
                            @if($report->closed_at)
                                <div><small>et terminée le {{ date('d/m/Y à H:i', strtotime($report->closed_at)) }}
                                        .</small></div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="Card_Support--Side">
                    <div class="d-grid gap-1">
                        <span
                            class="rcf-badge rcf-badge--{{ $report->status_color }}">{{ $report->status_label }}</span>
                        @if(($report->isPending() || $report->isInProgress()) && auth()->user()->can('reports.update'))
                            <div class="btn-group">
                                <button type="button" class="btn btn-light dropdown-toggle" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                    Actions
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    @if($report->isPending())
                                        <li>
                                            <button class="dropdown-item text-end" popovertarget="po-{{ $report->id }}">
                                                Démarrer<i class="bi bi-pencil-square ms-2"></i></button>
                                        </li>
                                    @endif
                                    @if($report->isInProgress())
                                        <li><a class="dropdown-item text-end"
                                               href="{{ route('support.reports.edit', $report->identifier) }}">
                                                Editer<i class="bi bi-pencil-square ms-2"></i></a></li>
                                    @endif
                                </ul>
                            </div>
                        @elseif($report->isClosed())
                            <div class="btn-group">
                                <button type="button" class="btn btn-light dropdown-toggle" data-bs-toggle="dropdown"
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
            <div id="po-{{ $report->id }}" popover="manual">
                <h5 class="mb-3">Démarrer l'édition du rapport d'expertise {{ $report->identifier }} ?</h5>
                {{ html()->form('patch', route('support.reports.start', $report))->open() }}
                <div class="d-grid mb-2"><input type="submit" class="btn btn-lg btn-primary" value="Oui" name="do"/>
                </div>
                {{ html()->form()->close() }}
                <div class="d-grid">
                    <button popovertarget="po-{{ $report->id }}" popovertargetaction="hide" class="btn btn-sm">Annuler
                    </button>
                </div>
            </div>
        @endforeach
    @endif
</div>
