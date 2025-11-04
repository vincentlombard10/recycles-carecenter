<x-app-layout>
    <x-page-header>
        <div class="page-header-content">
            Exporter
        </div>
    </x-page-header>
    <x-page-wrapper>
        <x-messages />
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 mb-3">
                    <a href="{{ route('support.tickets.index') }}" class="btn btn-sm btn-dark">Retour</a>
                </div>
            </div>
            {{ html()->form('POST', route('zendesk.tickets.export.post'))->open() }}
            <div class="row">
                <div class="col-md-6 col-xl-3 mb-2">
                    <label for="from" class="form-label mb-1">Début de la période</label>
                    <input type="datetime-local" class="form-control" id="from" name="from" required value="{{ $start_time }}">
                </div>
                <div class="col-md-6 col-xl-3 mb-2">
                    <label for="to" class="form-label mb-1">Fin de la période</label>
                    <input type="datetime-local" class="form-control" id="to" name="to" required value="{{ $end_time }}">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-xl-3 mb-2">
                    <input type="submit" class="btn btn-primary" value="Démarrer l'exportation">
                </div>
            </div>
            {{ html()->form()->close() }}
        </div>
    </x-page-wrapper>
</x-app-layout>
