<div class="mb-5">
    <h2>02. Ticket associé</h2>
    @if($productReturn->ticket)
    <table class="table table-sm">
        <tbody>
        <tr>
            <th style="width: 16rem;">ID Zendesk Support</th>
            <td>{{ $productReturn->ticket?->id }}</td>
        </tr>
        <tr>
            <th>Demandeur</th>
            <td>{{ $productReturn->ticket?->requester_name }}</td>
        </tr>
        <tr>
            <th>Sujet</th>
            <td>{{ $productReturn->ticket?->subject }}</td>
        </tr>
        </tbody>
    </table>
    @else
    <div class="alert alert-info">Aucun ticket associé</div>
    @endif
</div>
