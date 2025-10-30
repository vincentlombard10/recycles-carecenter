<table class="table">
    <thead>
    <tr>
        <th style="width: 24rem;">Désignation</th>
        <th>Coordonnées postales</th>
        <th style="width: 8rem;"></th>
    </tr>
    </thead>
    <tbody>
    @foreach($contact->addresses as $address)
        <tr>
            <td>
                <div><span class="fw-bold">{{ $address->name }}</span></div>
                @if($address->isPrimary())
                    <div>(Adresse principale)</div>
                @endif
            </td>
            <td>
                <div>{{ $address->address1 }}</div>
                <div>{{ $address->address2 }}</div>
                <div>{{ $address->postcode }} {{$address->city }}</div>
            </td>
            <td>
                <div class="dropdown">
                    <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Action
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('contacts.addresses.edit', ['id' => $contact->id, 'address' => $address]) }}">Editer</a></li>
                        @if($address->isSecondary())
                        <li><a class="dropdown-item" href="{{ route('contacts.addresses.makePrimary', ['id' => $contact->id, 'address' => $address]) }}">Basculer en adresse principale</a></li>
                        @endif
                    </ul>
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
