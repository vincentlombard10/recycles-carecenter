<x-app-layout>
    <x-page-header>
        <h1 class="mb-0">Tableau de bord</h1>
    </x-page-header>
    <x-page-wrapper>
        <div class="mx-auto max-w-[1200px]">
            <x-messages />
            @include('dashboard.sections.section-product-returns')
            @hasanyrole(['superadmin', 'admin', 'agent'])
            @include('dashboard.sections.top-components')
            @endhasanyrole
            @include('dashboard.sections.section-product-reports')
            @hasanyrole(['superadmin', 'admin'])
            @include('dashboard.sections.section-serials')
            @include('dashboard.sections.section-items')
            @include('dashboard.sections.section-contacts')
            @endhasanyrole
        </div>
    </x-page-wrapper>
</x-app-layout>
