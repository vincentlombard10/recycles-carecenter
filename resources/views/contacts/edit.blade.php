<x-app-layout>
    <x-page-header>
        <h1>Editer un contact</h1>
    </x-page-header>
    <x-page-wrapper>
        <div><a href="{{ route('contacts.index') }}">Retour</a></div>
        <div>
            {{ html()->form()->open() }}
            <div class="mb-2">
                {{ html()->label('Nom')->for('name')->class('form-label') }}
            </div>
            {{ html()->form()->close() }}
        </div>
    </x-page-wrapper>
</x-app-layout>
