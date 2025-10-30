<x-app-layout>
    <x-page-header>
        @canany(['returns.create'])
        <a
            href="{{ route('support.returns.create') }}"
            class="page-header-btn page-header-btn-primary"><i class="bi bi-plus-circle"></i>
        </a>
        @endcanany
        <div class="page-header-content"><livewire:search-form /></div>
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
