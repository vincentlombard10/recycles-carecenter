<x-app-layout>
    <x-page-header>
        <div class="page-header-content">
            <div>
                <h1 class="m-0">ChangeLog</h1>
            </div>
            <div class="d-flex align-content-center gap-2">
                @hasanyrole('superadmin')
                <a
                    href="{{ route('changelogs.create') }}"
                    class="btn btn-circle btn-violet"><i class="bi bi-plus"></i>
                </a>
                @endhasanyrole
                <livewire:search-form />
            </div>
        </div>
    </x-page-header>
    <x-page-wrapper>
        <livewire:change-log-index />
    </x-page-wrapper>
</x-app-layout>
