<x-app-layout>
    <x-page-header>
        <h1>Retour {{ $productReturn->identifier }}</h1>
        <div class="page-header--actions">
        </div>
    </x-page-header>
    <x-page-wrapper>
        <a href="{{ route('support.returns.index') }}">Retour</a>
    </x-page-wrapper>
</x-app-layout>
