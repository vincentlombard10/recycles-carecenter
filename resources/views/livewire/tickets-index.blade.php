<div>
    <div class="mb-3">{{ $tickets->links() }}</div>
    <div class="mb-3">
        @foreach($tickets as $ticket)
            <div class="rcf-card Card_Ticket Card_Ticket__{{ $ticket->status }}">
                <div class="Card_Ticket_Content">
                    <div>
                        <h2 class="fw-semibold mb-1">{{ $ticket->id }}</h2>
                        @if ($ticket->contact)
                            <div class="mb-1"><span class="fw-semibold">{{ $ticket->contact->code }}</span> - {{ $ticket->contact->name }}</div>
                        @endif
                        <div>{{ $ticket->via }}</div>
                        @if($ticket->comments_count)
                            <span class="badge" style="background-color: oklch(94.3% 0.029 294.588);">{{ $ticket->comments_count }}<i class="bi bi-chat ms-2"></i>
</span>
                        @else
                            <a href="{{ route('zendesk.tickets.sync', ['id' => $ticket->id]) }}">Get comments</a>
                        @endif
                        @if ($ticket->fields_count)
                            <span class="badge bage-success" style="background-color: oklch(90.1% 0.076 70.697)">TF</span>
                        @endif
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
                    <div class="d-grid gap-2">
                        <span class="rcf-badge rcf-badge--{{ strtolower($ticket->status) }}">{{ $ticket->status_label }}</span>
                        <div class="btn-group">
                            <button type="button" class="btn btn-light dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                Actions
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item text-end" href="{{ route('support.tickets.show', ['zendeskID' => $ticket->id]) }}">Consulter<i class="bi bi-eye ms-2"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div>{{ $tickets->links() }}</div>
</div>
