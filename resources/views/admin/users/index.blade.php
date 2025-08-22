<x-app-layout>
    <x-page-header>
        <h1>Comptes utilisateurs</h1>
    </x-page-header>
    <x-page-wrapper>
        <div class="mb-3">
            <a href="{{ route('admin.users.create') }}">Nouvel utilisateur</a>
        </div>
        <livewire:search-form />
        <livewire:users-index />
    </x-page-wrapper>
</x-app-layout>
