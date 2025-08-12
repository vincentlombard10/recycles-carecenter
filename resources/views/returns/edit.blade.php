<x-app-layout>
    <x-page-header>
        <h1>Retour produit {{ $return->identifier }}</h1>
        <div class="page-header--actions">
        </div>
    </x-page-header>
    <x-page-wrapper>
        <x-messages />
        <div class="mb-3">
            <a href="{{ route('support.returns.index') }}" class="btn btn-sm btn-dark">Retour</a>
        </div>
        {{ html()->form('PATCH', route('support.returns.update', $return))->open() }}
        <div class="mb-3">
            {{ html()->select('status', [
                \App\Models\ProductReturn::STATUS_PENDING => 'En attente',
                \App\Models\ProductReturn::STATUS_RECEIVED => 'Reçu',
                \App\Models\ProductReturn::STATUS_FIRST_QUOTATION => 'Transmission Devis 1',
                \App\Models\ProductReturn::STATUS_FIRST_QUOTATION_REMINDER => 'Relance Devis 1',
                \App\Models\ProductReturn::STATUS_FIRST_QUOTATION_APPROVED => 'Devis 1 Accepté',
                \App\Models\ProductReturn::STATUS_FIRST_QUOTATION_REJECTED => 'Devis 1 Refusé',
                \App\Models\ProductReturn::STATUS_SECOND_QUOTATION => 'Transmission Devis 2',
                \App\Models\ProductReturn::STATUS_SECOND_QUOTATION_REMINDER => 'Relance Devis 2',
                \App\Models\ProductReturn::STATUS_SECOND_QUOTATION_APPROVED => 'Devis 2 Accepté',
                \App\Models\ProductReturn::STATUS_SECOND_QUOTATION_REJECTED => 'Devis 2 Refusé',
                \App\Models\ProductReturn::STATUS_SHIPPED => 'Expédié',
                \App\Models\ProductReturn::STATUS_FINISHED => 'Fin de processus',
                \App\Models\ProductReturn::STATUS_CANCELLED => 'Annulé'
        ], $return->status)->class('form-control') }}
        </div>
        <div class="mb-3">
            {{ html()->submit('Submit')->class('btn btn-primary') }}
        </div>
        {{ html()->form()->close() }}
        @if ($return->trashed())
        <div class="restore-zone mb-3">
            <h4>Restore Zone</h4>
            <p>Pour restaurer ce retour produit, cliquez sur le bouton ci-dessous.</p>
            {{ html()->form('POST', route('support.returns.restore', $return->identifier))->open() }}
            {{ html()->submit('Restaurer')->class('btn btn-info') }}
            {{ html()->form()->close() }}
        </div>
        @endif

        <button type="button" class="btn {{ $return->trashed() ? 'btn-danger' : 'btn-dark' }}" data-bs-toggle="modal" data-bs-target="#modal">
            {{ $return->trashed() ? 'Supprimer définitivement' : 'Archiver' }}
        </button>


        <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        @if($return->trashed())
                        <h5 class="modal-title" id="exampleModalLabel">Souhaitez-vous supprimer définitivement le retour {{ $return->identifier }} ?</h5>
                        @else
                            <h5 class="modal-title" id="exampleModalLabel">Souhaitez-vous réellement archiver le retour {{ $return->identifier }} ?</h5>
                        @endif
                    </div>
                    <div class="modal-mobdy p-3">
                        @if ($return->trashed())
                            {{ html()->form('DELETE', route('support.returns.forceDelete', $return))->open() }}
                            <p>Pour confirmer la <span class="fw-bold">suppression définitive</span> de ce retour produit, renseignez le champ ci-dessous avec le code <span class="fw-semibold">{{ $return->identifier }}</span>.</p>
                        @else
                            {{ html()->form('DELETE', route('support.returns.destroy', $return))->open() }}
                            @if($return->trashed())
                                <p>Pour confirmer la suppression de ce retour produit, renseignez le champ ci-dessous avec le code <span class="fw-semibold">{{ $return->identifier }}</span>.</p>
                            @else
                                <p>Pour confirmer l'archivage de ce retour produit, renseignez le champ ci-dessous avec le code <span class="fw-semibold">{{ $return->identifier }}</span>.</p>
                            @endif
                        @endif
                        <div class="row mb-3">
                            <div class="col-lg-6">{{ html()->text('confirmation')->class('form-control') }}</div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-dark">{{ $return->trashed() ? 'Supprimer' : 'Archiver' }}</button>
                        {{ html()->form()->close() }}
                    </div>
                </div>
            </div>
        </div>
    </x-page-wrapper>
</x-app-layout>
