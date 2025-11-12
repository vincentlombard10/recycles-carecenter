<x-app-layout>
    <x-page-header>
        <div class="page-header-content">
            <div class="d-flex align-items-center gap-3">
                <a href="{{ route('support.returns.index') }}" class="btn btn-circle btn-orange">
                    <i class="bi bi-arrow-left"></i>
                </a>
                <h1>Nouveau retour produit</h1>
            </div>
            <div>

            </div>
        </div>
    </x-page-header>
    <x-page-wrapper>
        <div class="container-fluid p-5">
            {{ html()->form('POST', route('support.returns.store'))->open() }}
            <div class="row">
                <div class="col-lg-4 mb-5">
                    <label for="environment" class="form-label mb-1">Environnement</label>
                    <select name="environment" id="environment" class="form-control">
                        <option value="production">Retour réel</option>
                        <option value="sandbox">Retour fictif (bac à sable)</option>
                    </select>
                </div>
            </div>
            <div id="product-return-form"></div>
            <div class="row">
                <div class="col-12">
                    <input type="submit" value="Créer" class="btn btn-lg btn-primary">
                </div>
            </div>
            {{ html()->form()->close() }}
        </div>
    </x-page-wrapper>
</x-app-layout>
