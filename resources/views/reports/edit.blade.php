<x-app-layout>
    <x-page-header>
        <h1>Rapport d'intervention {{ $report->identifier }}</h1>
    </x-page-header>
    <x-page-wrapper>
        <div class="page-header--actions">
            <a href="{{ route('support.returns.index') }}" class="btn btn-secondary">Retour</a>
        </div>
        {{ html()->form('PATCH', route('support.reports.update', $report))->open() }}
        <div id="product-report-form" data-identifier="{{ $report->identifier }}"></div>
        {{ html()->form()->close() }}
    </x-page-wrapper>
</x-app-layout>
