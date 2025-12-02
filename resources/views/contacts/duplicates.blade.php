<x-app-layout>
    <x-page-header>
        <div class="page-header-content">
            <h1 class="m-0">Comptes en doublon sur Zendesk</h1>
        </div>
    </x-page-header>
    <x-page-wrapper>
        <div class="container-fluid p-3">
            <div class="row">
                <div class="col-12 mb-3">
                    <a href="{{ route('contacts.index') }}" class="btn btn-sm btn-dark">Retour</a>
                </div>
            </div>
            <div class="row">
                @foreach($contacts as $contact)
                    <div class="Card_Contact">
                        <div class="Card_Contact--Body">
                            <div class="Card_Contact--Main">
                                <div>
                                    <div><h2 class="font-semibold mb-0">{{ $contact->code }}</h2></div>
                                    <div>
                                        @if($contact->zendesk_user_id)
                                            <small class="font-semibold text-success">{{ $contact->zendesk_user_id }}</small>
                                        @elseif($contact->duplicates)
                                            <small class="font-semibold text-warning">Plusieurs utilisateurs Zendesk</small>
                                        @elseif(!$contact->support_enabled == null)
                                            <small class="font-semibold text-danger">Aucun utilisateur Zendesk</small>
                                        @else
                                            <small class="text-secondary">Non défini</small>
                                        @endif
                                    </div>
                                    <div><small>{{ $contact->name }}</small></div>
                                </div>
                                <div>
                                    @foreach(json_decode($contact->duplicates) as $d)
                                        <div class="card p-2">
                                            <div><h6><span class="font-semibold">{{ $d->name }}</span> ({{ $d->id }})</h6></div>
                                            <div><span class="font-semibold">Création :</span> {{ date('d/m/Y à H:i', strtotime($d->created_at)) }}</div>
                                            <div><span class="font-semibold">Adresse e-mail :</span> {{ $d->email }}</div>
                                            <div><span class="font-semibold">Téléphone :</span> {{ $d->phone }}</div>
                                            <div><span class="font-semibold">ID externe :</span> {{ $d->external_id }}</div>
                                            <div><span class="font-semibold">Détails :</span> {{ $d->details }}</div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="Card_Contact--Side">
                            <div class="d-grid gap-1">
                                <span class="rcf-badge rcf-badge--{{ $contact->status }}">{{ $contact->status_label }}</span>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-light dropdown-toggle" data-bs-toggle="dropdown"
                                            aria-expanded="false">
                                        Actions
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li><button class="dropdown-item text-end" href="{{ route('contacts.show', $contact) }}">Editer<i class="bi bi-pencil-square ms-2"></i></button></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </x-page-wrapper>
</x-app-layout>
