<div>
    <div class="mb-3">{{ $tickets->links() }}</div>
    <div class="mb-3">
        <table class="table">
            <tbody>
            @foreach($tickets as $ticket)
                <tr class="tr--{{ strtolower($ticket->status) }}">
                    <td class="ps-4 pe-2 py-4">
                        <div><h5 class="fw-bold">{{ $ticket->id }}</h5></div>
                        <div>{{ $ticket->priority  }}</div>
                    </td>
                    <td class="px-2 py-4">
                        <div>{{ date('d/m/Y', $ticket->created_at) }}</div>
                        <div>{{ date('H:i', $ticket->created_at) }}</div>
                    </td>
                    <td class="px-2 py-4">
                        <div>{{ $ticket->requester_name }}</div>
                        <div>{{ $ticket->ticket_form_name }}</div>
                        <div>{{ $ticket->subject }}</div>
                    </td>
                    <td class="px-2 py-4">
                        <div>{{ $ticket->brand_name }}</div>
                        <div>{{ $ticket->assignee_name }}</div>
                    </td>
                    <td class="ps-2 pe-4 py-4">{{ $ticket->status }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div>{{ $tickets->links() }}</div>
</div>
