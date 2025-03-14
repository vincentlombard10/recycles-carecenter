<x-app-layout>
    <x-page-header>
        <h1>Retours produits</h1>
        <div class="page-header--actions">
            <a href="{{ route('support.returns.index') }}" class="btn btn-secondary">Retour</a>
        </div>
    </x-page-header>
    <x-page-wrapper>
        {{ html()->form('POST', route('support.returns.store'))->open() }}
        <div id="product-return-form"></div>
        {{ html()->form()->close() }}
    </x-page-wrapper>
</x-app-layout>
