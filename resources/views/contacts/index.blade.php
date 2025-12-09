<x-app-layout>
    <x-page-header>
        <div class="flex justify-between items-center w-full">
            <h1 class="m-0">Contacts clients</h1>
            <div class="flex gap-2">
                <div class="flex gap-4">
                    <div class="flex gap-2">
                        <a href="{{ route('contacts.duplicates') }}"
                           class="group flex px-1 h-10 bg-amber-200 rounded-full justify-center items-center hover:bg-amber-400"><span
                                class="bg-amber-600 flex justify-center items-center w-8 h-8 rounded-full text-white group-hover:bg-amber-600"><i
                                    class="bi bi-exclamation"></i></span>
                        </a>
                    </div>
                    <livewire:search-form/>
                </div>
            </div>
        </div>
    </x-page-header>
    <x-page-wrapper>
        <livewire:contacts-index />
    </x-page-wrapper>
</x-app-layout>
