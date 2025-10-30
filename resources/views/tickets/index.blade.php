<x-app-layout>
    <x-page-header>
        <div class="page-header-content">
            <livewire:search-form />
        </div>
    </x-page-header>
    <x-page-wrapper>
        <x-messages />
        <div class="mb-3">
            <a href="{{ route('support.tickets.export.form') }}" class="btn btn-sm btn-violet">Exporter les ticket Zendesk</a>
        </div>
        <div class="">
            <livewire:tickets-index />
        </div>
    </x-page-wrapper>
</x-app-layout>
