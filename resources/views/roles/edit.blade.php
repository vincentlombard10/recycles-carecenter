<x-app-layout>
    <x-page-header>
        <h1>Rôles</h1>
    </x-page-header>
    <x-page-wrapper>
        <div class="card">
            <div class="card-body p-5">
                {{ $role->name }}
            </div>
        </div>
    </x-page-wrapper>
</x-app-layout>
