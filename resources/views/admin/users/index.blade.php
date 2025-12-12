<x-app-layout>
    <x-page-header>
        <div class="flex justify-between items-center w-full">
            <div class="flex gap-2 items-center">
                <x-heroicon-o-user class="w-6 h-6" stroke-width="1.5"/>
                <h1 class="mb-0">Utilisateurs</h1>
            </div>
            <div class="flex gap-4 items-center">
                <div class="flex gap-2">
                    <a href="{{ route('admin.users.create') }}"
                       class="group flex px-1 h-10 bg-violet-200 rounded-full justify-center items-center hover:bg-violet-400"><span
                            class="bg-violet-600 flex justify-center items-center w-8 h-8 rounded-full text-white group-hover:bg-violet-600"><i
                                class="bi bi-plus"></i></span>
                    </a>
                </div>
                <livewire:search-form />
            </div>
        </div>
    </x-page-header>
    <x-page-wrapper>
        <livewire:users-index />
    </x-page-wrapper>
</x-app-layout>
