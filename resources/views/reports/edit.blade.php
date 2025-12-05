<x-app-layout>
    <x-page-header>
        <div class="page-header-content">
            <div class="flex gap-4 items-center">
                <a href="{{ route('support.reports.index') }}" class="btn btn-circle btn-orange">
                    <i class="bi bi-arrow-left"></i>
                </a>
                <h1 class="m-0">Rapport d'intervention {{ $report->identifier }}</h1>
            </div>
            <div>

            </div>
        </div>
    </x-page-header>
    <x-page-wrapper>
        <div class="container-fluid p-3">
            {{ html()->form('PATCH', route('support.reports.update', $report))->acceptsFiles()->open() }}
            <div id="product-report-form" data-report="{{ $report->identifier }}"></div>
            <input type="submit" class="bg-violet-800 font-bold text-white w-full px-4 py-4 rounded-lg hover:bg-violet-900 cursor-pointer" value="Enregistrer">
            {{ html()->form()->close() }}
        </div>
    </x-page-wrapper>
</x-app-layout>
