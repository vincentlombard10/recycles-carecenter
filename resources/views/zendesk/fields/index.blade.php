<x-app-layout>
    <x-page-header>
        <div class="flex px-4 justify-between items-center w-full">
            <h1>Champs personnalisés Zendesk</h1>
            <div class="flex gap-2">
                <a href="{{ route('support.tickets.export.form') }}"
                   class="group flex px-1 h-10 bg-sky-200 rounded-full justify-center items-center hover:bg-sky-400"><span
                        class="bg-sky-600 flex justify-center items-center w-8 h-8 rounded-full text-white group-hover:bg-sky-600"><i
                            class="bi bi-cloud-download"></i></span>
                </a>
            </div>
        </div>
    </x-page-header>
    <x-page-wrapper>
        {{ html()->form('PUT', route('zendesk.fields.update-all'))->open() }}
        @foreach($ticket_fields as $tf)
            <div class="flex gap-4 mb-2">
                <input name="{{ $tf->id }}" type="checkbox" id="field_{{ $tf->id }}" class="w-5 h-5" @if($tf->is_exportable) checked @endif>
                <label for="field_{{ $tf->id }}">{{ $tf->title }}</label>
            </div>
        @endforeach
        <div>
            <input type="submit" class="bg-violet-600 textwhite font-bold py-3 w-full rounded">
        </div>
        {{html()->form()->close() }}
    </x-page-wrapper>
</x-app-layout>
