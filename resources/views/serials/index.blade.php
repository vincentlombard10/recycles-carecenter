<x-app-layout>
    <x-page-header>
        <div class="page-header-content">
            <livewire:search-form />
        </div>
    </x-page-header>
    <x-page-wrapper>
        @if(\App\Models\Serial::count() > 0)
            <livewire:serials-index />
        @else
            <div class="alert">Il ne se passe pas grand chose ici.</div>
        @endif
    </x-page-wrapper>
</x-app-layout>
