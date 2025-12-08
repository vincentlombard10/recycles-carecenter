<x-app-layout>
    <x-page-header>
        <div class="page-header-content">
            <div>
                <h1 class="m-0">Exportation des tickets Zendesk</h1>
            </div>
            <div></div>
        </div>
    </x-page-header>
    <x-page-wrapper>
        <div class="container-fluid p-3">
            <x-messages />
            <div class="row">
                <div class="col-12 mb-3">
                    <a href="{{ route('support.tickets.index') }}" class="btn btn-sm btn-dark">Retour</a>
                </div>
            </div>
            {{ html()->form('POST', route('zendesk.tickets.export.post'))->open() }}
            <div class="bg-violet-200 px-4 py-3 rounded mb-3 flex justify-between items-center">
                <div>Personnalisez le fichier d'exporation en sélectionnant les colonnes souhaitées.</div>
                <a class="bg-violet-600 px-6 py-2 text-white rounded font-bold" href="{{ route('zendesk.fields.index') }}">Personnaliser</a>
            </div>
            <div class="grid grid-cols-3 gap-4 items-end">
                <div class="">
                    <label for="from" class="form-label mb-1">Début de la période</label>
                    <input type="datetime-local" class="form-control" id="from" name="from" required value="{{ $start_time }}">
                </div>
                <div class="">
                    <label for="to" class="form-label mb-1">Fin de la période</label>
                    <input type="datetime-local" class="form-control" id="to" name="to" required value="{{ $end_time }}">
                </div>
                <div class="">
                    <input type="submit" class="bg-violet-500 px-4 py-2 rounded w-full text-white font-bold" value="Démarrer l'exportation">
                </div>
            </div>
            {{ html()->form()->close() }}
        </div>
    </x-page-wrapper>
</x-app-layout>
