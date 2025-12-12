<x-app-layout>
    <x-page-header>
        <div class="flex justify-between items-center w-full">
            <div class="flex gap-2 items-center">
                <x-heroicon-o-qr-code class="w-6 h-6" stroke-width="1.5"/>
                <h1 class="mb-0">Numéros de série</h1>
            </div>
            <div>
                <livewire:search-form />
            </div>
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
