<x-guest-layout>
    <div class="mt-4 mb-4 text-sm text-gray-600 dark:text-gray-400">
        <h6>Vous avez oublié vote mot de passe ?</h6>
        <p>Aucun souci, renseignez votre adresse e-mail et vous recevrez un lien pour renouveler votre mot de passe.</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <div>
            <label for="email" class="form-label mb-1">Adresse e-mail</label>
            <input type="text" name="email" class="form-control" value="{{ old('email') }}" required autofocus>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="d-grid mb-3">
            <input type="submit" class="btn btn-primary" value="Recevoir le lien de renouvellement.">
        </div>
        <div>
            <a href="/">Retour</a>
        </div>
    </form>
</x-guest-layout>
