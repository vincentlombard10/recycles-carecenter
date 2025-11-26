<div>
    <div class="row mb-3">
        <div class="col-lg-3">
            <select name="status" id="status" class="form-control" wire:model.live="status">
                <option value="">Tous</option>
                <option value="incomplete">Incomplet</option>
                <option value="pending">En attente</option>
                <option value="received">Reçu</option>
            </select>
        </div>
        <div class="col-lg-3">
            <select name="environment" id="environment" class="form-control" wire:model.live="environment">
                <option value="">Tous</option>
                <option value="production">Réels</option>
                <option value="sandbox">Fictif</option>
            </select>
        </div>
        <x-pagination :items="$items" class="col-lg-6"/>
    </div>
@if (count($items))
        <div class="mb-3">
            @foreach($items as $item)
                <div class="Card_Support Card_Support--{{ $item->status }} rounded-lg">
                    <div class="Card_Support--Body">
                        <div class="Card_Support--Main mb-2">
                            <div class="grid gap-1">
                                <h2 class="fw-semibold mb-2">{{ $item->identifier }}</h2>
                                @if($item->environment === \App\Models\ProductReturn::ENV_SANDBOX)
                                    <div class="d-grid mb-1">
                                        <span class="badge badge-{{ $item->environment }}">Sandbox</span>
                                    </div>
                                @endif
                                <div class="d-grid mb-1">
                                    <span class="badge">{{ $item->type_label }}</span>
                                </div>
                                <div class="d-grid mb-1">
                                    <span class="badge">{{ $item->context_label }}</span>
                                </div>
                                <div class="d-grid mb-1">
                                    <span class="badge">
                                        <div>{{ $item->ticket_id }}</div>
                                        @if($item->ticket?->contact)
                                            <div><span class="text-primary">{{ $item->ticket?->contact->code }}</span></div>
                                        @endif
                                    </span>
                                </div>
                            </div>
                            <div>
                                @if($item->type === 'bike')
                                    <x-card-bike :item="$item"/>
                                @elseif($item->type === 'component')
                                    <x-card-component :item="$item"/>
                                @elseif($item->type === 'battery')
                                    <x-card-battery :item="$item"/>
                                @else
                                    <div>Non défini</div>
                                @endif
                                @if($item->bike_sold_at)
                                    <div><small>DVD : {{ date('d/m/Y', strtotime($item->bike_sold_at)) }}</small></div>
                                @endif
                                @if($item->bike_purchased_at)
                                    <div><small>DVC : {{ date('d/m/Y', strtotime($item->bike_purchased_at)) }}</small>
                                    </div>
                                @endif
                            </div>
                            <div>
                                <ul class="mb-2">
                                    <li><small>Crée le {{ date('d/m/Y à H:i', strtotime($item->created_at)) }}
                                            par {{ $item->author->username }}</small></li>
                                    @if($item->validated_at)
                                        <li><small>Validé le {{ date('d/m/Y à H:i', strtotime($item->validated_at)) }}
                                                par {{ $item->validator?->username }}</small>
                                        </li>
                                    @endif
                                    @if($item->received_at)
                                        <li><small>Réceptionné le {{ date('d/m/Y à H:i', strtotime($item->received_at)) }}
                                                par {{ $item->receiver?->username }}</small></li>
                                    @endif
                                </ul>
                                <h4 class="font-bold mb-1">Acheminement</h4>
                                <ul>
                                    <li class="mb-1">
                                        <div class="text-xs px-2 py-1 rounded-sm">
                                            de <span class="font-bold">{{ $item->routing_from_code }} {{ $item->routing_from_address1 }}</span>
                                        </div>
                                    </li>
                                    <li class="mb-1">
                                        <div class="text-xs px-2 py-1 rounded-sm">
                                            vers <span class="font-bold">{{ $item->routing_to_code }} {{ $item->routing_to_address1 }}</span>
                                        </div>
                                    </li>
                                    @if($item->return_to)
                                    <li class="mb-1">
                                        <div class="text-xs px-2 py-1 bg-violet-200 rounded-sm">
                                            retourné à <span class="font-bold">{{ $item->return_to_code }} {{ $item->return_to_address1 }}</span>
                                        </div>
                                    </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="Card_Support--Side">
                        <div class="d-grid gap-2">
                            <div class="rcf-badge rcf-badge--{{ $item->status }}">{{ $item->status_label }}</div>
                            <div class="btn-group">
                                <button type="button" class="btn btn-light dropdown-toggle" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                    Actions
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item text-end"
                                           href="{{ route('support.returns.show', $item->identifier) }}">Consulter<i
                                                class="bi bi-eye ms-2"></i>
                                        </a>
                                    </li>
                                    @canany(['returns.update', 'returns.edit'])
                                        @if(!$item->isReceived())
                                            <li><a class="dropdown-item text-end"
                                                   href="{{ route('support.returns.edit', $item->identifier) }}">Editer<i
                                                        class="bi bi-pencil-square ms-2"></i></a></li>
                                        @endif
                                        @if($item->received_at === null && $item->isPending())
                                            <li>
                                                <button class="dropdown-item text-end"
                                                        popovertarget="po-{{ $item->id }}">
                                                    Réceptionner<i class="bi bi-pencil-square ms-2"></i></button>
                                            </li>
                                        @endif
                                    @endcanany
                                    @if($item->isPending() || $item->isReceived() )
                                        <li>
                                            <a class="dropdown-item text-end"
                                               href="{{ route('support.returns.download', $item->identifier) }}">Télécharger<i
                                                    class="bi bi-download ms-2"></i>
                                            </a>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="po-{{ $item->id }}" popover="manual">
                    <h5 class="mb-3">Valider la réception du retour {{ $item->identifier }} ?</h5>
                    {{ html()->form('patch', route('support.returns.updateReception', $item))->open() }}
                    <div class="d-grid mb-2"><input type="submit" class="btn btn-lg btn-primary" value="Oui"
                                                    name="return_received"/></div>
                    {{ html()->form()->close() }}
                    <div class="d-grid">
                        <button popovertarget="po-{{ $item->id }}" popovertargetaction="hide" class="btn btn-sm">Annuler
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
        <x-pagination :items="$items" />
    @else
        <div>Il ne se passe pas grand chose ici.</div>
    @endif
</div>
