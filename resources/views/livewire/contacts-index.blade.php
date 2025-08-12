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
                <td class="py-3">
                    <div><span class="fw-bold">{{ $contact->code }}</span></div>
                    <div><small>{{ $contact->name }}</small></div>
                </td>
                <td class="py-3">
                    <div><small>{{ $contact->address1 }}</small></div>
                    <div><small>{{ $contact->address2 }}</small></div>
                    <div><small>{{ $contact->postalcode }} {{ $contact->city }}</small></div>
                </td>
                <td class="py-3">
                    {{ $contact->country }}
                </td>
                <td class="py-3">
                    <div>{{ $contact->phone }}</div>
                    <div>{{ $contact->email }}</div>
                </td>
                <td class="py-3">
                    <div class="d-grid">
                        <span class="badge badge--{{ $contact->status }}">{{ $contact->status_label }}</span>
                    </div>
                </td>
                <td class="py-3">
                    <a href="{{ route('contacts.show', $contact) }}" class="btn btn-sm btn-dark">Editer</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $contacts->onEachSide(1)->links() }}
</div>
