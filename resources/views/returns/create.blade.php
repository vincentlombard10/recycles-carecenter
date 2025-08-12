<x-app-layout>
    <x-page-header>
        <h1>Retours produits</h1>
    </x-page-header>
    <x-page-wrapper>
        <div class="mb-3">
            <a href="{{ route('support.returns.index') }}" class="btn btn-sm btn-primary">Retour</a>
        </div>
        {{ html()->form('POST', route('support.returns.store'))->open() }}
        <div id="product-return-form"></div>
        {{ html()->form()->close() }}
    </x-page-wrapper>
</x-app-layout>
