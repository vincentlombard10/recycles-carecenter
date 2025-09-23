<x-app-layout>
    <x-page-header>
        <livewire:search-form />
    </x-page-header>
    <x-page-wrapper>
        @canany(['returns.create'])
        <div class="mb-3">
            <a href="{{ route('support.returns.create') }}" class="btn btn-primary">Nouveau retour</a>
        </div>
        @endcanany
        @if($returns_count > 0)
        <livewire:product-returns-index />
        @else
            <div class="alert alert-primary">Il ne se passe pas grand chose ici.</div>
        @endif
    </x-page-wrapper>
</x-app-layout>
