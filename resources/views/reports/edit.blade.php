<x-app-layout>
    <x-page-header>
        <div class="flex px-4 justify-between items-center w-full">
            <div class="flex items-center gap-4">
            <a href="{{ route('support.reports.index') }}"
               class="group flex px-1 h-10 bg-orange-500 rounded-full justify-center items-center hover:bg-orange-500"><span
                    class="bg-orage-600 flex justify-center items-center w-8 h-8 rounded-full text-white group-hover:bg-orange-700"><i
                        class="bi bi-cloud-download"></i></span>
            </a>
            <h1 class="m-0">Rapport d'intervention {{ $report->identifier }}</h1>
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
