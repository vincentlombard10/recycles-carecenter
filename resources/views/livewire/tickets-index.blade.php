<div>
    <div class="mb-3">{{ $tickets->links() }}</div>
    <div class="mb-3">
        @foreach($tickets as $ticket)
            <div class="rcf-card Card_Ticket Card_Ticket__{{ $ticket->status }}">
                <div class="Card_Ticket_Content">
                    <div>
                        <h2 class="fw-semibold">{{ $ticket->id }}</h2>
                        <div>{{ $ticket->requester_name }}</div>
                        <div><span class="fw-semibold">{{ $ticket->requester_email }}</span></div>
                        <div>{{ $ticket->ticket_form_name }}</div>
                        <div>{{ $ticket->subject }}</div>
                        <div><span class="text-primary">{{ date('d/m/Y H:i', $ticket->created_at) }}</span></div>
                    </div>
                    <div>
                        <div><small>1ère réponse : {{ $ticket->first_reply_time_in_minutes }} / {{ $ticket->first_reply_time_in_minutes_within_business_hours }}</small></div>
                        <div><small>1ère résolution : {{ $ticket->first_resolution_time_in_minutes }} / {{ $ticket->first_resolution_time_in_minutes_within_business_hours }}</small></div>
                        <div><small>Résolution complète : {{ $ticket->full_resolution_time_in_minutes }} / {{ $ticket->full_resolution_time_in_minutes_within_business_hours }}</small></div>
                        <div><small>Réponses : {{ $ticket->replies }}</small></div>
                        <div><small>Réouvertures : {{ $ticket->reopens }}</small></div>
                    </div>
                </div>
                <div>
                    <div class="d-grid">
                        <span class="rcf-badge rcf-badge--{{ strtolower($ticket->status) }}">{{ $ticket->status_label }}</span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div>{{ $tickets->links() }}</div>
</div>
