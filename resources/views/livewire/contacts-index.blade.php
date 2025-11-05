<div>
    <div class="mb-3">
        {{ $contacts->onEachSide(1)->links() }}
    </div>
    <div class="mb-3">
        @foreach ($contacts as $contact)
            <div class="Card_Contact">
                <div class="Card_Contact--Body">
                    <div class="Card_Contact--Main">
                        <div>
                            <div><h2 class="fw-semibold mb-0">{{ $contact->code }}</h2></div>
                            <div>
                                @if($contact->zendesk_user_id)
                                    <small class="fw-semibold text-success">{{ $contact->zendesk_user_id }}</small>
                                @elseif($contact->duplicates)
                                    <small class="fw-semibold text-warning">Plusieurs utilisateurs Zendesk</small>
                                @elseif(!$contact->support_enabled == null)
                                    <small class="fw-semibold text-danger">Aucun utilisateur Zendesk</small>
                                @else
                                    <small class="fw-normal text-secondary">Non défini</small>
                                @endif
                            </div>
                            <div><small>{{ $contact->name }}</small></div>
                        </div>
                        <div>
                            <div><small>{{ $contact->address1 }}</small></div>
                            <div><small>{{ $contact->address2 }}</small></div>
                            <div><small>{{ $contact->postcode }} {{ $contact->city }}</small></div>
                        </div>
                        <div>
                            <div>{{ $contact->phone }}</div>
                            <div>{{ $contact->email }}</div>
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
    {{ $contacts->onEachSide(1)->links() }}
</div>
