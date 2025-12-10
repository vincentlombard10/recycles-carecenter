<x-app-layout>
    <x-page-header>
        <h1 class="m-0">Nouvel utilisateur</h1>
    </x-page-header>
    <x-page-wrapper>
        {{ html()->form('POST', route('admin.users.store'))->open() }}
        <div class="bg-violet-50 p-8 rounded-lg">
            <div class="grid grid-cols-2 gap-6 mb-3">
                <div>
                    {{ html()->label('Identifiant M3')->for('username')->class('inline-block font-semibold mb-1 text-violet-900') }}
                    {{ html()->text('username')->class('form-control')->required() }}
                </div>
            </div>
            <div class="grid grid-cols-2 gap-6 mb-3">
                <div>
                    {{ html()->label('Prénom')->for('firstname')->class('inline-block font-semibold mb-1 text-violet-900') }}
                    {{ html()->text('firstname')->class('form-control')->required() }}
                </div>
                <div>
                    {{ html()->label('Nom')->for('lastname')->class('inline-block font-semibold mb-1 text-violet-900') }}
                    {{ html()->text('lastname')->class('form-control')->required() }}
                </div>
            </div>
            <div class="mb-3">
                {{ html()->label('Adresse e-mail')->for('email')->class('inline-block font-semibold mb-1 text-violet-900') }}
                {{ html()->text('email')->class('form-control')->required() }}
            </div>
            <div class="mb-3">
                {{ html()->label('Rôle')->for('role')->class('inline-block font-semibold mb-1 text-violet-900') }}
                <select name="role" id="role" class="form-control">
                    <option selected disabled>Sélectionner</option>
                    @foreach($roles as $role)
                        <option value="{{ $role->name }}">{{ $role->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3 flex gap-2 items-center">
                {{ html()->checkbox('is_active')->class('w-5 h-5') }}
                {{ html()->label('Actif ?')->for('is_active')->class('inline-block font-semibold text-violet-900') }}
            </div>
            <div>
                {{ html()->submit('Ajouter')->class('bg-violet-700 text-white font-semibold px-4 py-2 rounded w-full') }}
            </div>
        </div>
        {{ html()->form()->close() }}
    </x-page-wrapper>
</x-app-layout>
