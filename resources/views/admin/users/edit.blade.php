<x-app-layout>
    <x-page-header>
        <h1 class="m-0">Editer l'utilisateur {{ $user->username }}</h1>
    </x-page-header>
    <x-page-wrapper>
        {{ html()->form('PUT', route('admin.users.update', $user->id))->open() }}
        <div class="bg-violet-50 p-8 rounded-lg">
            <div class="grid grid-cols-2 gap-6 mb-3">
                <div>
                    {{ html()->label('Identifiant')->for('username')->class('inline-block font-semibold mb-1 text-violet-900') }}
                    {{ html()->text('username')->class('form-control')->value($user->username)->disabled() }}
                </div>
            </div>
            <div class="grid grid-cols-2 gap-6 mb-3">
                <div>
                    {{ html()->label('Prénom')->for('firstname')->class('inline-block font-semibold mb-1 text-violet-900') }}
                    {{ html()->text('firstname')->class('form-control')->value($user->firstname) }}
                </div>
                <div>
                    {{ html()->label('Nom')->for('lastname')->class('inline-block font-semibold mb-1 text-violet-900') }}
                    {{ html()->text('lastname')->class('form-control')->value($user->lastname) }}
                </div>
            </div>
            <div class="mb-3">
                {{ html()->label('Adresse e-mail')->for('email')->class('inline-block font-semibold mb-1 text-violet-900') }}
                {{ html()->text('email')->class('form-control')->value($user->email) }}
            </div>
            <div class="mb-3">
                {{ html()->label('Rôle')->for('role')->class('inline-block font-semibold mb-1 text-violet-900') }}
                <select name="role" id="role" class="form-control">
                    <option selected disabled>Sélectionner</option>
                    @foreach($roles as $role)
                        <option
                            value="{{ $role->name }}" {{ $user->getRoleNames()[0] === $role->name ? 'selected': '' }}>{{ $role->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3 flex gap-2 items-center">
                {{ html()->checkbox('is_active')->class('w-5 h-5') }}
                {{ html()->label('Actif ?')->for('is_active')->class('inline-block font-semibold text-violet-900') }}
            </div>
            <div>
                {{ html()->submit('Mettre à jour')->class('w-full bg-violet-800 text-white px-4 py-2 rounded font-semibold') }}
            </div>
        </div>
        {{ html()->form()->close() }}
    </x-page-wrapper>
</x-app-layout>
