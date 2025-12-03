<x-app-layout>
    <x-page-header>
        <div class="flex px-4 justify-between items-center w-full">
            <h1 class="m-0">Devis</h1>
            <div>
                <livewire:search-form />
            </div>
        </div>
    </x-page-header>
    <x-page-wrapper>
        <livewire:estimates-index />
    </x-page-wrapper>
</x-app-layout>
