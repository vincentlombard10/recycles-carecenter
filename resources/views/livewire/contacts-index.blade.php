<div>
    <table class="table">
        <thead>
        <tr>
            <th style="width: 16rem;">Identité</th>
            <th style="width: auto;">Adresse postale</th>
            <th style="width: auto;">Pays</th>
            <th style="width: auto;">Tel / E-mail</th>
            <th style="width: auto;">Statut</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach ($contacts as $contact)
            <tr>
                <td>
                    <div><span class="fw-bold">{{ $contact->id }}</span></div>
                    <div><small>{{ $contact->name }}</small></div>
                </td>
                <td>
                    <div><small>{{ $contact->address1 }}</small></div>
                    <div><small>{{ $contact->address2 }}</small></div>
                    <div><small>{{ $contact->postalcode }} {{ $contact->city }}</small></div>
                </td>
                <td>
                    {{ $contact->country }}
                </td>
                <td>
                    <div>{{ $contact->phone }}</div>
                    <div>{{ $contact->email }}</div>
                </td>
                <td>
                    <div class="d-grid">
                        <span class="badge badge--{{ $contact->status }}">{{ $contact->status_label }}</span>
                    </div>
                </td>
                <td>
                    <a href="{{ route('contacts.show', $contact) }}" class="btn btn-sm btn-dark">Editer</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $contacts->onEachSide(1)->links() }}
</div>
