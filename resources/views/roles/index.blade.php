<x-app-layout>
    <x-page-header>
        <div class="flex justify-between items-center w-full">
            <div class="flex gap-2 items-center">
                <x-heroicon-o-users class="w-6 h-6" stroke-width="1.5"/>
                <h1 class="m-0">Rôles</h1>
            </div>
            <div>
                <livewire:search-form />
            </div>
        </div>
    </x-page-header>
    <x-page-wrapper>
        <livewire:roles-index />
    </x-page-wrapper>
</x-app-layout>
