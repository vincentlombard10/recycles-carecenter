<div>
    @if (count($items))
        @foreach($items as $item)
            <div class="Card_Support Card_Support--{{ $item->status }}">
                <div class="Card_Support--Body">
                    <div class="Card_Support--Main mb-2">
                        <div>
                            <h2 class="fw-semibold">{{ $item->identifier }}</h2>
                            <div class="d-grid mb-1">
                                <span class="badge">{{ $item->type_label }}</span>
                            </div>
                            <div class="d-grid mb-1">
                                <span class="badge">{{ $item->context_label }}</span>
                            </div>
                            <div class="d-grid mb-1">
                                <span class="badge">{{ $item->ticket_id }}</span>
                            </div>
                        </div>
                        <div>
                            <div class="mb-2"><span class="badge">{{ $item->customer_code }}</span></div>
                            @if($item->type === 'bike')
                                <x-card-bike :item="$item" />
                            @elseif($item->type === 'component')
                                <x-card-component :item="$item" />
                            @elseif($item->type === 'battery')
                                <x-card-battery :item="$item" />
                            @else
                                <div>Non défini</div>
                            @endif
                        </div>
                        <ul>
                            <li><small>Crée le {{ date('d/m/Y à H:i', strtotime($item->created_at)) }} par {{ $item->author->username }} .</small></li>
                            @if($item->offered_at)
                            <li><small>Validé le {{ date('d/m/Y à H:i', strtotime($item->offered_at)) }}</small></li>
                            @endif
                            @if($item->received_at)
                            <li><small>Réceptionné le {{ date('d/m/Y à H:i', strtotime($item->received_at)) }} par {{ $item->receiver?->username ?? '-' }}</small></li>
                            @endif
                        </ul>
                    </div>
                </div>
                <div class="Card_Support--Side">
                    <div class="d-grid gap-2">
                        <div class="rcf-badge rcf-badge--{{ $item->status }}">{{ $item->status_label }}</div>
                        <div class="btn-group">
                            <button type="button" class="btn btn-light dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                Actions
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item text-end" href="{{ route('support.returns.show', $item->identifier) }}">Consulter<i class="bi bi-eye ms-2"></i>
                                    </a>
                                </li>
                                @canany(['returns.update', 'returns.edit'])
                                    @if($item->status !== \App\Models\ProductReturn::STATUS_RECEIVED)
                                        <li><a class="dropdown-item text-end" href="{{ route('support.returns.edit', $item->identifier) }}">Editer<i class="bi bi-pencil-square ms-2"></i></a></li>
                                    @endif
                                    @if($item->received_at === null && $item->status === \App\Models\ProductReturn::STATUS_PENDING)
                                        <li><button class="dropdown-item text-end" popovertarget="po-{{ $item->id }}">Réceptionner<i class="bi bi-pencil-square ms-2"></i></button></li>
                                    @endif
                                @endcanany
                                <li>
                                    <a class="dropdown-item text-end" href="{{ route('support.returns.download', $item->identifier) }}">Télécharger<i class="bi bi-download ms-2"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div id="po-{{ $item->id }}" popover="manual">
                <h5 class="mb-3">Valider la réception du retour {{ $item->identifier }} ?</h5>
                {{ html()->form('patch', route('support.returns.updateReception', $item))->open() }}
                <div class="d-grid mb-2"><input type="submit" class="btn btn-lg btn-primary" value="Oui" name="return_received"/></div>
                {{ html()->form()->close() }}
                <div class="d-grid">
                    <button popovertarget="po-{{ $item->id }}" popovertargetaction="hide" class="btn btn-sm">Annuler</button>
                </div>
            </div>
        @endforeach
    @else
        <div>Il ne se passe pas grand chose ici.</div>
    @endif

</div>
