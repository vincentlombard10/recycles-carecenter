<x-app-layout>
    <x-page-header>
        <div class="flex justify-between items-center w-full">
            <h1 class="m-0">Groupes</h1>
            <div class="flex gap-4">
                <livewire:search-form />
            </div>
        </div>
    </x-page-header>
    <x-page-wrapper>
        <livewire:groups-index />
    </x-page-wrapper>
</x-app-layout>
