<x-app-layout>
    <x-page-header>
        <h1>Retour {{ $productReturn->identifier }}</h1>
        <div class="page-header--actions">
        </div>
    </x-page-header>
    <x-page-wrapper>
        <div class="mb-3">
            <a href="{{ route('support.returns.index') }}" class="btn btn-sm btn-dark"">Retour</a>
        </div>
        <div class="card">
            <div class="card-body p-5">
                @include('returns.partials.01_qualification')
                @include('returns.partials.02_ticket')
                @include('returns.partials.03_serial_or_item')
                @include('returns.partials.04_sales_info')
                @include('returns.partials.05_comments')
                @include('returns.partials.06_routing')
            </div>
        </div>
    </x-page-wrapper>
</x-app-layout>
