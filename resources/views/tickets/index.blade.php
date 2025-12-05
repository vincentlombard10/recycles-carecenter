<x-app-layout>
    <x-page-header>
        <div class="flex px-4 justify-between items-center w-full">
            <h1 class="m-0">Tickets Zendesk Support</h1>
            <div class="flex gap-4">
                <div class="flex gap-2">
                    <a href="{{ route('support.tickets.export.form') }}"
                       class="group flex px-1 h-10 bg-sky-200 rounded-full justify-center items-center hover:bg-sky-400"><span
                            class="bg-sky-600 flex justify-center items-center w-8 h-8 rounded-full text-white group-hover:bg-sky-600"><i
                                class="bi bi-cloud-download"></i></span>
                    </a>
                </div>
                <livewire:search-form/>
            </div>
        </div>
    </x-page-header>
    <x-page-wrapper>
        <x-messages/>
        <div class="mb-3">
            <x-dashboard.counter
                title="nouveaux"
                class="New"
                :count="$tickets_new" />
            <x-dashboard.counter
                title="ouverts"
                class="Open"
                :count="$tickets_open" />
            <x-dashboard.counter
                title="en attente"
                class="Hold"
                :count="$tickets_hold" />
        </div>
        <div class="">
            <livewire:tickets-index/>
        </div>
    </x-page-wrapper>
</x-app-layout>
