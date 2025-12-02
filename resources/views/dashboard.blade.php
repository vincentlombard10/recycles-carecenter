<x-app-layout>
    <x-page-header>
        <div class="page-header-content">
            <div>
                <h1 class="mb-0">Tableau de bord</h1>
            </div>
            <div></div>
        </div>
    </x-page-header>
    <x-page-wrapper>
        <div class="container-fluid p-3 ">
            <x-messages />
            @include('dashboard.sections.section-product-returns')
            @include('dashboard.sections.top-components')
            @include('dashboard.sections.section-product-reports')
            @include('dashboard.sections.section-serials')
            @include('dashboard.sections.section-items')
            @include('dashboard.sections.section-contacts')
        </div>
    </x-page-wrapper>
</x-app-layout>
