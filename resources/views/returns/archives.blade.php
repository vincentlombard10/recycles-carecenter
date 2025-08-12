<x-app-layout>
    <x-page-header>
        <h1>Retours produits - Archives</h1>
        <div class="page-header--actions">
        </div>
    </x-page-header>
    <x-page-wrapper>
        <div class="mb-3">
            <a href="{{route('support.returns.index')}}" class="btn btn-sm btn-dark">Retour</a>
        </div>
        <livewire:search-form />
        <livewire:product-returns-index :trashed="true"/>
    </x-page-wrapper>
</x-app-layout>
