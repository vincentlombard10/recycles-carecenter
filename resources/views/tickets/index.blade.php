<x-app-layout>
    <x-page-header>
        <div class="page-header-content">
            <div>
                <h1>Tickets Zendesk Support</h1>
            </div>
            <div class="d-flex align-content-center gap-2">
                <a href="{{ route('support.tickets.export.form') }}"
                    class="btn btn-circle btn-cyan">
                    <i class="bi bi-cloud-download"></i>
                </a>
                <livewire:search-form />
            </div>
        </div>
    </x-page-header>
    <x-page-wrapper>
        <x-messages />
        <div class="">
            <livewire:tickets-index />
        </div>
    </x-page-wrapper>
</x-app-layout>
