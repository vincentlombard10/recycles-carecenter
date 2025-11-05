<x-app-layout>
    <x-page-header>
        <div class="page-header-content">
            <div>
                <h1>Contacts clients</h1>
            </div>
            <div class="d-flex align-items-center gap-2">
                <a href="{{ route('contacts.duplicates') }}" class="btn btn-circle btn-amber">
                    <i class="bi bi-exclamation-lg"></i>
                </a>
                <livewire:search-form />
            </div>
        </div>
    </x-page-header>
    <x-page-wrapper>
        <livewire:contacts-index />
    </x-page-wrapper>
</x-app-layout>
