<x-app-layout>
    <x-page-header>
        <div class="page-header-content">
            <div class="d-flex align-items-center gap-3">
                <a href="{{ route('qualifications.index') }}" class="btn btn-circle btn-orange">
                    <i class="bi bi-arrow-left"></i>
                </a>
                <h1>Nouvelle qualification</h1>
            </div>
            <div>

            </div>
        </div>
    </x-page-header>
    <x-page-wrapper>
        <div class="container-fluid p-5">
            {{ html()->form('POST', route('qualifications.store'))->open() }}
            <div class="mb-3">
                <label for="name" class="form-label mb-1">Nom / Label</label>
                <input type="text" class="form-control" name="name" />
            </div>
            <div class="mb-3">
                <label for="description" class="form-label mb-1">Description (facultatif)</label>
                <input type="text" class="form-control" name="description" />
            </div>
            <div>
                <input type="submit" class="btn btn-primary btn-lg" value="Créer">
            </div>
            {{ html()->form()->close() }}
        </div>
    </x-page-wrapper>
</x-app-layout>
