<x-app-layout>
    <x-page-header>
        <div class="page-header-content">
            <div class="d-flex align-items-center gap-3">
                <a href="{{ route('support.reports.index') }}" class="btn btn-circle btn-orange">
                    <i class="bi bi-arrow-left"></i>
                </a>
                <h1>Rapport d'intervention {{ $report->identifier }}</h1>
            </div>
            <div>

            </div>
        </div>
    </x-page-header>
    <x-page-wrapper>
        <div class="container-fluid p-3">
            {{ html()->form('PATCH', route('support.reports.update', $report))->open() }}
            <div id="product-report-form" data-report="{{ $report->identifier }}"></div>
            <input type="submit" class="btn btn-lg btn-primary" value="Enregistrer">
            {{ html()->form()->close() }}
        </div>
    </x-page-wrapper>
</x-app-layout>
