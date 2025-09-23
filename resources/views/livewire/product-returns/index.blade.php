<div>
    @if (count($items))
        @foreach($items as $item)
            <div class="rcf-card Card_Return">
                <div class="Card_Return--Info mb-3 mb-xl-0">
                    <div>
                        <h2>{{ $item->identifier }}</h2>
                        <div><small>Type</small></div>
                        <div>{{ $item->type }}</div>
                        <div>{{ $item->context }}</div>
                        <div>{{ $item->ticket_id }}</div>
                    </div>
                    <div>
                        <div>{{ $item->reason }}</div>
                        <div>{{ $item->item_itno }}</div>
                    </div>
                    <div>
                        <div>{{ $item->assignation }}</div>
                        <div>{{ $item->action }}</div>
                        <div>{{ $item->desination }}</div>
                    </div>
                    <div>
                        <div>{{ $item->order }}</div>
                        <div>{{ $item->bike_sold_at }}</div>
                        <div>{{ $item->invoice }}</div>
                        <div>{{ $item->delivery }}</div>
                    </div>
                </div>
                <div class="d-table-row gap-2">
                    <div class="rcf-badge">{{ $item->status }}</div>
                    <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-outline-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            Actions
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item text-end" href="{{ route('support.returns.show', $item->identifier) }}">Consulter<i class="bi bi-eye ms-2"></i>
                                </a>
                            </li>
                            @canany(['returns.update', 'returns.edit'])
                                <li><a class="dropdown-item text-end" href="{{ route('support.returns.edit', $item->identifier) }}">Editer<i class="bi bi-pencil-square ms-2"></i></a></li>
                            @endcanany
                            <li>
                                <a class="dropdown-item text-end" href="{{ route('support.returns.download', $item->identifier) }}">Télécharger<i class="bi bi-download ms-2"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <div>Il ne se passe pas grand chose ici.</div>
    @endif

</div>
