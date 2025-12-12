<x-app-layout>
    <x-page-header>
        <div class="flex justify-between items-center w-full">
            <div class="flex gap-2 items-center">
                <x-heroicon-o-document-currency-euro class="w-6 h-6" stroke-width="1.5"/>
                <h1 class="mb-0">Devis</h1>
            </div>
            <div>
                <livewire:search-form />
            </div>
        </div>
    </x-page-header>
    <x-page-wrapper>
        <livewire:estimates-index />
    </x-page-wrapper>
</x-app-layout>
