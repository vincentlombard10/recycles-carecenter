<x-app-layout>
    <x-page-header>
        <h1 class="m-0">Nouvel utilisateur</h1>
    </x-page-header>
    <x-page-wrapper>
        {{ html()->form('POST', route('admin.users.store'))->open() }}
        <div class="card">
            <div class="card-body p-5">
                <div class="form-group mb-3">
                    {{ html()->label('Prénom')->for('firstname')->class('form-label') }}
                    {{ html()->text('firstname')->class('form-control')->required() }}
                </div>
                <div class="form-group mb-3">
                    {{ html()->label('Nom')->for('lastname')->class('form-label') }}
                    {{ html()->text('lastname')->class('form-control')->required() }}
                </div>
                <div class="form-group mb-3">
                    {{ html()->label('Username')->for('username')->class('form-label') }}
                    {{ html()->text('username')->class('form-control')->required() }}
                </div>
                <div class="form-group mb-3">
                    {{ html()->label('Adresse e-mail')->for('email')->class('form-label') }}
                    {{ html()->text('email')->class('form-control')->required() }}
                </div>
                <div class="form-group mb-3">
                    {{ html()->label('Rôle')->for('role')->class('form-label') }}
                    <select name="role" id="role" class="form-control">
                        <option selected disabled>Sélectionner</option>
                        @foreach($roles as $role)
                            <option value="{{ $role->name }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-check mb-3">
                    {{ html()->checkbox('send_email')->value('send_email')->class('form-check-input') }}
                    {{ html()->label('Envoyer un e-mail')->class('form-check-inline')->for('send_email') }}
                </div>
                <div>
                    {{ html()->submit('Create')->class('btn btn-primary') }}
                </div>
            </div>
        </div>
        {{ html()->form()->close() }}
    </x-page-wrapper>
</x-app-layout>
