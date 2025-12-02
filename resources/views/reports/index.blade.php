<x-app-layout>
    <x-page-header>
        <div class="page-header-content">
            <div>
                <h1 class="m-0">Rapports d'intervention</h1>
            </div>
            <div class="d-flex align-content-center gap-2">
                <a href="{{ route('support.reports.export.form') }}"
                   class="btn btn-circle btn-cyan">
                    <i class="bi bi-cloud-download"></i>
                </a>
                <livewire:search-form />
            </div>
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
