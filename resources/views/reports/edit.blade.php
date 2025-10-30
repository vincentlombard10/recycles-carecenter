<x-app-layout>
    <x-page-header>
        <a
            href="{{ route('support.reports.index') }}"
            class="page-header-btn page-header-btn-secondary"><i class="bi bi-arrow-left-circle"></i>
        </a>
        <div class="page-header-content">
            <h1>Rapport d'intervention {{ $report->identifier }}</h1>
        </div>
    </x-page-header>
    <x-page-wrapper>
        <div class="container-fluid p-5">
            {{ html()->form('PATCH', route('support.reports.update', $report))->open() }}
            <div id="product-report-form" data-report="{{ $report->identifier }}"></div>
            <input type="submit" class="btn btn-lg btn-primary" value="Enregistrer">
            {{ html()->form()->close() }}
        </div>
    </x-page-wrapper>
</x-app-layout>
