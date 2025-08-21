<x-app-layout>
    <x-page-header>
        <h1>Numéros de série</h1>
    </x-page-header>
    <x-page-wrapper>
        @if(\App\Models\Serial::count() > 0)
            <livewire:search-form />
            <livewire:serials-index />
        @else
            <div class="alert">Il ne se passe pas grand chose ici.</div>
        @endif
    </x-page-wrapper>
</x-app-layout>
