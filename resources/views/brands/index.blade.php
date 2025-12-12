<x-app-layout>
    <x-page-header>
        <div class="flex justify-between items-center w-full">
            <div class="flex gap-2 items-center">
                <x-heroicon-o-tag class="w-6 h-6" stroke-width="1.5"/>
                <h1 class="mb-0">Marques</h1>
            </div>
            <div class="flex gap-4">
                <livewire:search-form />
            </div>
        </div>
    </x-page-header>
    <x-page-wrapper>
        <livewire:brands-index />
    </x-page-wrapper>
</x-app-layout>
