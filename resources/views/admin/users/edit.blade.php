<x-app-layout>
    <x-page-header>
        <h1 class="m-0">Editer l'utilisateur {{ $user->username }}</h1>
    </x-page-header>
    <x-page-wrapper>
        {{ html()->form('PUT', route('admin.users.update', $user->id))->open() }}
        <div class="form-group mb-3">
            {{ html()->label('Identifiant')->for('username')->class('form-label') }}
            {{ html()->text('username')->class('form-control')->value($user->username)->disabled() }}
        </div>
        <div class="form-group mb-3">
            {{ html()->label('Prénom')->for('firstname')->class('form-label') }}
            {{ html()->text('firstname')->class('form-control')->value($user->firstname) }}
        </div>
        <div class="form-group mb-3">
            {{ html()->label('Nom')->for('lastname')->class('form-label') }}
            {{ html()->text('lastname')->class('form-control')->value($user->lastname) }}
        </div>
        <div class="form-group mb-3">
            {{ html()->label('Adresse e-mail')->for('email')->class('form-label') }}
            {{ html()->text('email')->class('form-control')->value($user->email) }}
        </div>
        <div class="form-group mb-3">
            {{ html()->label('Rôle')->for('role')->class('form-label') }}
            <select name="role" id="role" class="form-control">
                <option selected disabled>Sélectionner</option>
                @foreach($roles as $role)
                    <option
                        value="{{ $role->name }}" {{ $user->getRoleNames()[0] === $role->name ? 'selected': '' }}>{{ $role->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            {{ html()->submit('Mettre à jour')->class('w-full bg-violet-800 text-white px-4 py-2 rounded') }}
        </div>
        {{ html()->form()->close() }}
    </x-page-wrapper>
</x-app-layout>
