<x-app-layout>
    <x-page-header>
        <div class="page-header-content">
            <div>
                <h1>Rapports d'intervention</h1>
            </div>
            <livewire:search-form />
        </div>
    </x-page-header>
    <x-page-wrapper>
        <x-messages />
        @if($reports_count > 0)
        <livewire:product-reports-index />
        @else
        <div class="alert">Il ne se passe pas grand chose ici.</div>
        @endif
    </x-page-wrapper>
</x-app-layout>
