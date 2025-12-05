<div>
    <div class="flex gap-2 mb-3">
        <div>
            <select name="status" id="status" class="form-control min-w-[8rem]" wire:model.live="status">
                <option value="">Tous</option>
                <option value="new">Nouveau</option>
                <option value="open">Ouvert</option>
                <option value="solved">Résolu</option>
                <option value="hold">En attente</option>
                <option value="closed">Clos</option>
            </select>
        </div>
        <x-pagination :items="$tickets" class="col-lg-6"/>
    </div>
    <x-pagination :items="$tickets" class="mb-3"/>
    <div class="mb-3">
        @foreach($tickets as $ticket)
            <div class="bg bg__{{ $ticket->status }} p-3 lg:p-4 mb-2 rounded-md">
                <div class="grid grid-cols-[auto_8rem] gap-4">
                    <div class="grid md:grid-cols-[8rem_auto] gap-4">
                        <div class="column-left">
                            <h2 class="font-bold text-2xl mb-2">{{ $ticket->id }}</h2>
                            <span
                                class="badge-small">{{ $ticket->contact?->code ?? '?' }}</span>
                            <span
                                class="badge-small">{{ stripslashes($ticket->via["channel"]) }}</span>
                        </div>
                        <div class="column-right grid grid-cols-2 gap-4">
                            <div class="max-h-[12rem] overflow-hidden bg-white/40 border-black/50 border-1 p-4 pb-0 rounded-lg">
                                {!! $ticket->comments->first()->html_body !!}
                            </div>
                            <div>
                                <span class="text-primary">{{ date('d/m/Y H:i', $ticket->created_at) }}</span>
                                <div><small>1ère réponse : {{ $ticket->first_reply_time_in_minutes }} / {{ $ticket->first_reply_time_in_minutes_within_business_hours }}</small></div>
                                <div><small>1ère résolution : {{ $ticket->first_resolution_time_in_minutes }} / {{ $ticket->first_resolution_time_in_minutes_within_business_hours }}</small></div>
                                <div><small>Résolution complète : {{ $ticket->full_resolution_time_in_minutes }} / {{ $ticket->full_resolution_time_in_minutes_within_business_hours }}</small></div>
                                <div><small>Réponses : {{ $ticket->replies }}</small></div>
                                <div><small>Réouvertures : {{ $ticket->reopens }}</small></div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div
                            class="badge {{ $ticket->status }} w-full mb-2">{{ $ticket->status_label }}</div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <x-pagination :items="$tickets" />
</div>
