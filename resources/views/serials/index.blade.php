<x-app-layout>
    <x-page-header>
        <h1>Numéros de série</h1>
    </x-page-header>
    <x-page-wrapper>
        <livewire:search-form />
        {{ \App\Models\Serial::count() }}
        @if(\App\Models\Serial::count())
        <livewire:serials-index />
        @endif
    </x-page-wrapper>
</x-app-layout>
