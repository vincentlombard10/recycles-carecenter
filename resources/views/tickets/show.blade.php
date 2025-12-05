<x-app-layout>
    <x-page-header>
        <div class="px-4"><h1 class="m-0">Ticket {{$ticket->id}}</h1></div>
    </x-page-header>
    <x-page-wrapper>
        <div class="mb-3">
            <div class="col-12 mb-3">
                <a href="{{ route('support.tickets.index') }}" class="btn btn-sm btn-dark">
                    <i class="bi bi-chevron-left me-1"></i>Retour</a>
            </div>
        </div>
        <div class="">
            <div>{{ $ticket->fields()->wherePivot('ticketfield_id', 16577615117074)->first()->value }}</div>
            <table class="table-auto bg-white w-full mb-3">
                <thead class="bg-violet-900 text-white py-2">
                <tr>
                    <th class="w-[12rem] py-1 text-xs">ID</th>
                    <th class="w-[6rem] py-1 text-xs">Type</th>
                    <th class="py-1 text-xs">Titre</th>
                    <th class="py-1 text-xs">Valeur</th>
                </tr>
                </thead>
                <tbody>
                @foreach($ticket->filledFields as $tf)
                    <tr class="@if($tf->pivot->value == null) table-secondary @endif">
                        <th style="width: 12rem;">{{ $tf->id }}</th>
                        <th>{{ $tf->type }}</th>
                        <td style="width: 50%;">{{ $tf->title }}</td>
                        <td>{{ $tf->pivot->value }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </x-page-wrapper>
</x-app-layout>
