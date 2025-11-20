<x-app-layout>
    <x-page-header>
        <div class="page-header-content">
            <div>
                <h1>Qualification {{ $qualification->id }}</h1>
            </div>
            <div class="d-flex align-content-center gap-2">
                <a href="{{ route('qualifications.index') }}" class="btn btn-circle btn-orange">
                    <i class="bi bi-arrow-left"></i>
                </a>
            </div>
        </div>
    </x-page-header>
    <x-page-wrapper>
        <x-messages />
        <div class="container-fluid p-3">
            <div class="mb-3">
                <label for="name" class="form-label">Nom d'affichage</label>
                <input type="text" class="form-control" name="name">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <input type="text" class="form-control" name="description">
            </div>
            <div id="qualification-form" data-id="{{ $qualification->id }}"></div>
        </div>
    </x-page-wrapper>
</x-app-layout>
