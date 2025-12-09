<x-app-layout>
    <x-page-header>
        <div class="page-header-content">
            <div class="d-flex align-items-center gap-3">
                <a href="{{ route('profile.index') }}" class="btn btn-circle btn-orange">
                    <i class="bi bi-arrow-left"></i>
                </a>
                <h1>Modifier le mot de passe</h1>
            </div>
        </div>
    </x-page-header>
    <x-messages />
    <x-page-wrapper>
        <div class="bg-sky-100 text-sky-950 px-6 py-4 rounded-lg mb-3">
            <p>Votre mot de passe doit :</p>
            <ul>
                <li>Contenir au moins 8 caractères</li>
                <li>Inclure des lettres majuscules et minuscules</li>
                <li>Contenir au moins un chiffre</li>
                <li>Contenir au moins un symbole</li>
            </ul>
        </div>
        <div class="bg-white px-6 py-4 rounded-lg mb-4">
            {{ html()->form('PUT', route('profile.password.update'))->open() }}
            @if ($errors->any())
                <ul class="bg-rose-100 text-rose-900 px-6 py-4 rounded-lg mb-4">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
            <div class="row">
                <div class="col-lg-6 mb-3">
                    <label for="current_password" class="form-label mb-1">Mot de passe actuel</label>
                    <input type="password" name="current_password" id="current_password" class="form-control">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 mb-3">
                    <label for="new_password" class="form-label mb-1">Nouveau mot de passe</label>
                    <input type="password" name="new_password" id="new_password" class="form-control">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 mb-3">
                    <label for="new_assword_confirmation" class="form-label mb-1">Confirmation du nouveau mot de psse</label>
                    <input type="password" name="new_password_confirmation" id="new_password_confirmation" class="form-control">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <input type="submit" class="bg-violet-600 text-white font-semibold hover:bg-violet-700 px-4 py-2 rounded" value="Valider">
                </div>
            </div>
            {{ html()->form()->close() }}
        </div>
    </x-page-wrapper>
</x-app-layout>
