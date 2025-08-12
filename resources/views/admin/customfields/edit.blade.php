<x-app-layout>
    <x-page-header>
        <h1>Custom Field {{ $customfield->id }} - {{ $customfield->name }}</h1>
    </x-page-header>
    <x-page-wrapper>
        <div class="mb-3">
            <a href="{{ route('customfields.index') }}">Custom fields</a>
        </div>
        <ul id="cfo-list">
            @foreach($customfield->options as $option)
                <li data-id="{{ $option->id }}"
                    class="cfo-item">
                    <span class="handle">
                        <i class="bi bi-grip-vertical"></i>
                    </span>
                    <div class="info">
                        <span><a href="{{ route('customfields.options.edit', $option->id) }}">{{ $option->label }}</a></span>
                        <span class="badge {{ $option->is_active ? 'badge--active' : 'badge--inactive' }}">{{ $option->is_active ? 'Actif' : 'Inactif' }}</span>
                    </div>
                </li>
            @endforeach
        </ul>
        <div>
            {{ html()->form('POST', route('customfields.options.store'))->open() }}
            {{ html()->hidden('field_id')->value($option->field->id) }}
            <div class="mb-3">
                {{ html()->label('Identifiant')->class('form-label') }}
                {{ html()->text('identifier')->class('form-control')->value('') }}
            </div>
            <div class="mb-3">
                {{ html()->label('Label')->class('form-label') }}
                {{ html()->text('label')->class('form-control')->value('') }}
            </div>
            <div>
                {{ html()->submit('Ajouter')->class('btn btn-primary') }}
            </div>
            {{ html()->form()->close() }}
        </div>
    </x-page-wrapper>
</x-app-layout>
