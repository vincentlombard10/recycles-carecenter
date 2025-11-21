<x-app-layout>
    <x-page-header>
        <div class="page-header-content">
            <div>
                <h1>Retours produits</h1>
            </div>
            <div class="d-flex align-content-center gap-2">
                <a href="{{ route('support.returns.create') }}" class="btn btn-circle btn-violet"><i class="bi bi-plus-lg"></i></a>
                <a href="{{ route('support.returns.export.form') }}"
                   class="btn btn-circle btn-cyan">
                    <i class="bi bi-cloud-download"></i>
                </a>
                <livewire:search-form />
            </div>
        </div>
    </x-page-header>
    <x-page-wrapper>
        <x-messages />
        @if($returns_count > 0)
        <livewire:product-returns-index />
        @else
            <div class="alert alert-primary">Il ne se passe pas grand chose ici.</div>
        @endif
    </x-page-wrapper>
</x-app-layout>
