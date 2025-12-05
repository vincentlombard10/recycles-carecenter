<x-app-layout>
    <x-page-header>
        <h1 class="m-0">Numéros de série orphelins</h1>
    </x-page-header>
    <x-page-wrapper>
        <livewire:search-form />
        <livewire:serials-index :orphans="true"/>
    </x-page-wrapper>
</x-app-layout>
