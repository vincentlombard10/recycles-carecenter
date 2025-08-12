<x-app-layout>
    <x-page-header>
        <h1>Rapports d'intervention</h1>
    </x-page-header>
    <x-page-wrapper>
        <x-messages />
        @if($reports_count > 0)
        <livewire:search-form />
        <livewire:product-reports-index />
        @else
        <div class="alert">Il ne se passe pas grand chose ici.</div>
        @endif
    </x-page-wrapper>
</x-app-layout>
