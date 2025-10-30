<x-app-layout>
    <x-page-header>
        @hasanyrole('superadmin')
            <a
                href="{{ route('admin.users.create') }}"
                class="page-header-btn page-header-btn-primary"><i class="bi bi-plus-circle"></i>
            </a>
        @endhasanyrole
        <div class="page-header-content"><livewire:search-form /></div>
    </x-page-header>
    <x-page-wrapper>
        <livewire:users-index />
    </x-page-wrapper>
</x-app-layout>
