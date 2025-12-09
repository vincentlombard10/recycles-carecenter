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
                @foreach($ticket->fields()->withTrashed() as $tf)
                    <tr class="border-b-slate-300 border-b-1 hover:bg-orange-100 @if($tf->pivot->value == null) bg-slate-200 @endif">
                        <td class="px-3 py-2">{{ $tf->id }}</td>
                        <td class="px-3 py-2">{{ $tf->type }}</td>
                        <td class="px-3 py-2">{{ $tf->title }}</td>
                        <td class="px-3 py-2">{{ $tf->pivot->value }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </x-page-wrapper>
</x-app-layout>
