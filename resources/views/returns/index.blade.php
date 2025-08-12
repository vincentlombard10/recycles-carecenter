<x-app-layout>
    <x-page-header>
        <h1>Retours produits</h1>
        <div class="page-header--actions">
        </div>
    </x-page-header>
    <x-page-wrapper>
        <div class="mb-3">
            <a href="{{ route('support.returns.create') }}" class="btn btn-primary">Nouveau retour</a>
        </div>
        @if($returns_count > 0)
        <livewire:search-form />
        <livewire:product-returns-index />
        @else
            <div class="alert alert-primary">Il ne se passe pas grand chose ici.</div>
        @endif
    </x-page-wrapper>
</x-app-layout>
