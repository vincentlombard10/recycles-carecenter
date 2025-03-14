<x-app-layout>
    <x-page-header>
        <h1>Retours produits</h1>
        <div class="page-header--actions">
            <a href="{{ route('support.returns.create') }}" class="btn btn-primary">Nouveau retour</a>
        </div>
    </x-page-header>
    <x-page-wrapper>
        <livewire:search-form />
        <livewire:product-returns-index />
    </x-page-wrapper>
</x-app-layout>
