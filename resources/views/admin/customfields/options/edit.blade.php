<x-app-layout>
    <x-page-header>
        <h1>CFO {{ $customFieldOption->id }}</h1>
    </x-page-header>
    <x-page-wrapper>
        <div>Utilisé dans le FormField <a href="{{ route('customfields.edit', $customFieldOption->field->id) }}">{{ $customFieldOption->field->id }}</a></div>
        {{ html()->form('PATCH', route('customfields.options.update', $customFieldOption))->open() }}
        <div class="mb-3">
            {{ html()->label('Identifiant')->for('identifier')->class('form-label') }}
            {{ html()->text('identifier')->class('form-control')->value($customFieldOption->identifier) }}
        </div>
        <div class="mb-3">
            {{ html()->label('Label')->for('label')->class('form-label') }}
            {{ html()->text('label')->class('form-control')->value($customFieldOption->label) }}
        </div>
        <div class="mb-3">
            {{ html()->label('Statut')->for('is_active')->class('form-label') }}
            {{ html()->select('is_active')->options(['active' => 'Actif', '' => 'Inactif'])->value($customFieldOption->is_active ? 'active': '')->class('form-control') }}
        </div>
        <div class="mb-3">
            {{ html()->submit('Enregistrer')->name('action')->value('update')->class('btn btn-primary') }}
        </div>
        <div class="row">
            <div class="col-xl-6">
                <div class="danger-zone mb-3">
                    {{ html()->label('Confirmation')->for('label')->class('form-label') }}
                    {{ html()->text('confirm')->class('form-control mb-3')->value('') }}
                    {{ html()->submit('Supprimer')->name('action')->value('delete')->class('btn btn-danger') }}
                </div>
            </div>
        </div>
        {{ html()->form()->close() }}
    </x-page-wrapper>
</x-app-layout>
