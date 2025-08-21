<x-app-layout>
    <x-page-header>
        <h1>Numéros de série</h1>
    </x-page-header>
    <x-page-wrapper>
        <livewire:search-form />
        @if(\App\Models\Serial::count() > 0)
        <livewire:serials-index />
        @else
            No serial
        @endif
    </x-page-wrapper>
</x-app-layout>
