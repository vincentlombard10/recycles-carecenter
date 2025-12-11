<div class="mx-auto max-w-[1200px]">
    <div class="flex gap-4 justify-between mb-3">
        <div class="flex gap-2">
            <div>
                <select name="status" id="status" class="form-control min-w-[8rem]" wire:model.live="status">
                    <option value="">Tous</option>
                    <option value="init">Retour en attente</option>
                    <option value="pending">En attente</option>
                    <option value="in_progress">En cours</option>
                    <option value="paused">Devis proposé</option>
                    <option value="closed">Terminé</option>
                </select>
            </div>
            <div class="col-lg-3">
                <select name="environment" id="environment" class="form-control min-w-[8rem]" wire:model.live="environment">
                    <option value="">Tous</option>
                    <option value="production">Réels</option>
                    <option value="sandbox">Fictif</option>
                </select>
            </div>
            <div>
                <select name="order" id="order" class="form-control min-w-[8rem]" wire:model.live="order">
                    <option value="created_at_desc">Création la plus récente</option>
                    <option value="created_at_asc">Création la plus ancienne</option>
                    <option value="updated_at_desc">Modification la plus récente</option>
                    <option value="updated_at_asc">Modification la plus ancienne</option>
                    <option value="started_at_desc">Démarrage le plus récent</option>
                    <option value="started_at_asc">Démarrage le plus ancien</option>
                    <option value="closed_at_desc">Clôture la plus récente</option>
                    <option value="closed_at_asc">Clôture la plus ancienne</option>
                </select>
            </div>
        </div>
        <x-pagination :items="$reports" class="col-lg-6"/>
    </div>
    <div>{{ $order }} - {{ $environment }} - {{ $status }}</div>
    <div class="mb-3">
        @forelse($reports as $report)
            <x-support.card-report :report="$report"/>
            <x-support.card-report-popver :report="$report" />
        @empty
            <div class="flex justify-between px-4 py-2 rounded bg-linear-to-r/oklch from-indigo-500 via-violet-500 to-purple-500 text-white text-xs">
                <div>Aucun résultat pour cette sélection.</div>
                <div><button wire:click="resetSelection" class="text-yellow-300 bg-transparent">Réinitialiser la sélection</button</div>
            </div>
        @endforelse
    </div>
    <x-pagination :items="$reports" />
</div>
