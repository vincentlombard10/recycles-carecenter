<div>
    <div class="grid grid-cols-4 gap-2 mb-3">
        <div>
            <select name="status" id="status" class="form-control w-full" wire:model.live="status">
                <option value="">Tous</option>
                <option value="incomplete">Incomplet</option>
                <option value="pending">En attente</option>
                <option value="received">Reçu</option>
            </select>
        </div>
        <div>
            <select name="environment" id="environment" class="form-control w-full" wire:model.live="environment">
                <option value="">Tous</option>
                <option value="production">Réels</option>
                <option value="sandbox">Fictif</option>
            </select>
        </div>
        <div class="col-span-2">
            <x-pagination :items="$items" />
        </div>
    </div>
    @if (count($items))
        <div class="mb-3">
            @foreach($items as $item)
                <div class="bg-white p-4 lg:p-8 mb-2 rounded-md">
                    <div class="grid md:grid-cols-[12rem_auto] gap-2">
                        <div class="column-left">
                            <h2 class="fw-semibold mb-2">{{ $item->identifier }}</h2>
                            @if($item->environment === \App\Models\ProductReturn::ENV_SANDBOX)
                                <div class="d-grid mb-1">
                                    <span class="badge badge-{{ $item->environment }} font-semibold">Sandbox</span>
                                </div>
                            @endif
                            <div class="d-grid mb-1">
                                <span class="badge font-semibold">{{ $item->type_label }}</span>
                            </div>
                            <div class="d-grid mb-1">
                                <span class="badge font-semibold">{{ $item->context_label }}</span>
                            </div>
                            <div class="d-grid mb-1">
                                    <span class="badge">
                                        <div>{{ $item->ticket_id }}</div>
                                        @if($item->ticket?->contact)
                                            <div><span
                                                    class="text-primary">{{ $item->ticket?->contact->code }}</span></div>
                                        @endif
                                    </span>
                            </div>
                        </div>
                        <div class="column-right">
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
                                <h4 class="font-bold mb-2">Acheminement</h4>
                                @if($item->from)
                                    <span
                                        class="font-bold bg-violet-100/90 px-2 py-1 rounded">{{ $item->routing_from_code }}</span>
                                @else
                                    <span
                                        class="font-bold bg-orange-500/90 px-2 py-1 rounded text-white">
                                            <i class="bi bi-exclamation-square"></i></span>

                                @endif
                                <i class="bi bi-caret-right"></i>
                                @if($item->to)
                                    <span
                                        class="font-bold bg-violet-100/80 px-2 py-1 rounded">{{ $item->routing_to_code }}</span>
                                @else
                                    <span
                                        class="font-bold bg-orange-500/90 px-2 py-1 rounded text-white">
                                            <i class="bi bi-exclamation-square"></i></span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="column-side">
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
        <x-pagination :items="$items"/>
    @else
        <div>Il ne se passe pas grand chose ici.</div>
    @endif
</div>
