<div>
    <div class="flex gap-2 mb-3">
        <div>
            <select name="status" id="status" class="form-control min-w-[8rem]" wire:model.live="status">
                <option value="">Tous</option>
                <option value="incomplete">Incomplet</option>
                <option value="pending">En attente</option>
                <option value="received">Reçu</option>
            </select>
        </div>
        <div>
            <select name="environment" id="environment" class="form-control min-w-[8rem]" wire:model.live="environment">
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
                <div class="bg-white p-3 lg:p-4 mb-2 rounded-md grid grid-cols-[auto_8rem] gap-4">
                    <div class="grid md:grid-cols-[8rem_auto] gap-4">
                        <div class="column-left">
                            <h2 class="font-bold text-2xl mb-2">{{ $item->identifier }}</h2>
                            @if($item->environment === \App\Models\ProductReturn::ENV_SANDBOX)
                                <div class="grid">
                                    <span class="badge badge-{{ $item->environment }} font-semibold">Sandbox</span>
                                </div>
                            @endif
                            <span class="inline-flex md:inline-block px-3 py-2 bg-slate-100 md:w-full mb-1.5 rounded font-bold text-center text-xs">{{ $item->type_label }}</span>
                            <span class="inline-flex md:inline-block px-3 py-2 bg-slate-100 md:w-full mb-1.5 rounded font-bold text-center text-xs">{{ $item->context_label }}</span>
                            <span class="inline-flex md:inline-block px-3 py-2 bg-slate-100 md:w-full mb-1.5 rounded font-bold text-center text-xs">
                                        <div>{{ $item->ticket_id }}</div>
                                        @if($item->ticket?->contact)
                                    <div><span
                                            class="text-blue-800 font-bold">{{ $item->ticket?->contact->code }}</span></div>
                                @endif
                                    </span>
                        </div>
                        <div class="column-right grid lg:grid-cols-[auto_16rem] gap-8">
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
                                <h4 class="font-bold mb-2 text-lg">Acheminement</h4>
                                @if($item->from)
                                    <span
                                        class="font-bold bg-violet-100/90 px-2 py-1 rounded">{{ $item->routing_from_code }}</span>
                                @else
                                    <span
                                        class="font-bold bg-orange-300 px-2 py-1 rounded text-orange-800">
                                            <i class="bi bi-exclamation"></i></span>

                                @endif
                                <i class="bi bi-caret-right-fill text-violet-600"></i>
                                @if($item->to)
                                    <span
                                        class="font-bold bg-violet-100/80 px-2 py-1 rounded">{{ $item->routing_to_code }}</span>
                                @else
                                    <span
                                        class="font-bold bg-orange-300 px-2 py-1 rounded text-orange-800">
                                            <i class="bi bi-exclamation"></i></span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="px-3 py-2 bg-slate-100 font-semibold text-center {{ $item->status }} w-full mb-2">{{ $item->status_label }}</div>
                        <div>
                            <el-dropdown>
                                <button
                                    role="button"
                                    popovertarget="item-{{ $item->identifier }}"
                                    class="inline-flex bg-violet-100 justify-center rounded-md w-full text-sm font-semibold text-gray-900 hover:bg-gray-50 py-2">
                                    Actions
                                    <svg viewBox="0 0 20 20" fill="currentColor" data-slot="icon" aria-hidden="true" class="-mr-1 size-5 text-gray-400">
                                        <path d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" fill-rule="evenodd" />
                                    </svg>
                                </button>

                                <el-menu anchor="bottom end" id="item-{{ $item->identifier }}" popover class="w-32 origin-top-right rounded-md bg-white shadow-lg outline-1 outline-black/5 transition transition-discrete [--anchor-gap:--spacing(2)] data-closed:scale-95 data-closed:transform data-closed:opacity-0 data-enter:duration-100 data-enter:ease-out data-leave:duration-75 data-leave:ease-in">
                                    <div class="py-0">
                                        <a href="{{ route('support.returns.edit', $item->identifier) }}" class="block px-4 py-2 text-sm text-gray-700 focus:bg-violet-200 focus:text-violet-900 focus:outline-hidden focus:font-semibold">Editer</a>
                                        @if($item->isPending() || $item->isReceived())
                                        <a href="{{ route('support.returns.download', $item->identifier) }}" class="block px-4 py-2 text-sm text-gray-700 focus:bg-violet-200 focus:text-violet-900 focus:outline-hidden focus:font-semibold">Télécharger</a>
                                        @endif
                                    </div>
                                </el-menu>
                            </el-dropdown>
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
