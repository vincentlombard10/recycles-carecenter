<div>
    <div class="row mb-3">
        <div class="col-lg-3">
            <select name="status" id="status" class="form-control" wire:model.live="status">
                <option value="">Tous</option>
                <option value="init">Retour en attente</option>
                <option value="pending">En attente</option>
                <option value="in_progress">En cours</option>
                <option value="paused">Devis proposé</option>
                <option value="closed">Terminé</option>
            </select>
        </div>
        <div class="col-lg-3">
            <select name="environment" id="environment" class="form-control" wire:model.live="environment">
                <option value="">Tous</option>
                <option value="production">Réels</option>
                <option value="sandbox">Fictif</option>
            </select>
        </div>
        <x-pagination :items="$reports" class="col-lg-6"/>
    </div>
    @if(count($reports))
        <div class="mb-3">
            @foreach($reports as $report)
                <x-support.card-report :report="$report"/>
                <x-support.card-report-popver :report="$report" />
            @endforeach
        </div>
    @endif
    <x-pagination :items="$reports" />
</div>
