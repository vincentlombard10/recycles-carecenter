<x-app-layout>
    <x-page-header>
        <a
            href="{{ route('support.returns.index') }}"
            class="page-header-btn page-header-btn-secondary"><i class="bi bi-arrow-left-circle"></i>
        </a>
        <div class="page-header-content">
            <h1>Retour produit {{ $return->identifier }}</h1>
        </div>
        <div class="page-header--actions">
        </div>
    </x-page-header>
    <x-page-wrapper>
        <x-messages/>
        <div class="container-fluid p-5">
            {{ html()->form('PATCH', route('support.returns.update', $return))->open() }}
            <div id="product-return-form" data-return="{{ $return }}"></div>
            <div class="mb-3">
                {{ html()->submit('Mettre à jour')->class('btn btn-lg btn-primary') }}
            </div>
            {{ html()->form()->close() }}
            @if($return->trashed())
                <button class="dropdown-item text-end" popovertarget="po-restaure">Restaurer</button>
                <div id="po-restaure" popover="manual">
                    <h5 class="mb-3">Souhaitez-vous restaurer le retour {{ $return->identifier }} ?</h5>
                    {{ html()->form('post', route('support.returns.restore', $return->identifier))->open() }}
                    <div class="d-grid mb-2"><input type="submit" class="btn btn-lg btn-primary" value="Oui" name="do"/></div>
                    <div class="d-grid mb-2"><input type="submit" class="btn btn-lg btn-dark" value="Non" name="dont"/></div>
                    {{ html()->form()->close() }}
                    <div class="d-grid">
                        <button popovertarget="po-restaure" popovertargetaction="hide" class="btn btn-sm">Annuler</button>
                    </div>
                </div>
                <button class="dropdown-item text-end" popovertarget="po-force-delete">Supprimer</button>

                <div id="po-force-delete" popover="manual">
                    <h5 class="mb-3">Souhaitez-vous supprimer définitivement le retour {{ $return->identifier }} ?</h5>
                    <p>Attention, une fois supprimé, ce retour ne pourra plus être récupéré.</p>
                    {{ html()->form('delete', route('support.returns.forceDelete', $return))->open() }}
                    <div class="d-grid mb-2"><input type="submit" class="btn btn-lg btn-primary" value="Oui" name="do"/></div>
                    <div class="d-grid mb-2"><input type="submit" class="btn btn-lg btn-dark" value="Non" name="dont"/></div>
                    {{ html()->form()->close() }}
                    <div class="d-grid">
                        <button popovertarget="po-delete" popovertargetaction="hide" class="btn btn-sm">Annuler</button>
                    </div>
                </div>
            @else
                <button class="dropdown-item text-end" popovertarget="po-archive">Archiver</button>
                <div id="po-archive" popover="manual">
                    <h5 class="mb-3">Souhaitez-vous archiver le retour {{ $return->identifier }} ?</h5>
                    {{ html()->form('delete', route('support.returns.destroy', $return))->open() }}
                    <div class="d-grid mb-2"><input type="submit" class="btn btn-lg btn-primary" value="Oui" name="do"/></div>
                    <div class="d-grid mb-2"><input type="submit" class="btn btn-lg btn-dark" value="Non" name="dont"/></div>
                    {{ html()->form()->close() }}
                    <div class="d-grid">
                        <button popovertarget="po-archive" popovertargetaction="hide" class="btn btn-sm">Annuler</button>
                    </div>
                </div>
            @endif
        </div>
    </x-page-wrapper>
</x-app-layout>
