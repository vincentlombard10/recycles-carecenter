<x-guest-layout>
    <div class="mt-4 mb-4 text-sm text-gray-600 dark:text-gray-400">
        <h6>Vous avez oublié vote mot de passe ?</h6>
        <p>Aucun souci, renseignez votre adresse e-mail et vous recevrez un lien pour renouveler votre mot de passe.</p>
    </div>

    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label font-semibold mb-1">Adresse e-mail</label>
            <input type="text" name="email" class="form-control" value="{{ old('email') }}" required autofocus>
        </div>

        <div class="d-grid mb-3">
            <input type="submit" class="bg-violet-800 px-4 py-2 w-full rounded text-white font-semibold" value="Recevoir le lien de renouvellement">
        </div>
        <div>
            <a href="/" class="font-semibold"><i class="bi bi-chevron-left"></i> Retour</a>
        </div>
    </form>

    @if ($errors->any())
        <div id="login-bottom-banner">
            @foreach($errors->all() as $e)
                <li>{{ $e }}</li>
            @endforeach
        </div>
    @endif

    @if(session('status'))
        <div id="login-status-banner">
            {{ session('status') }}
        </div>
    @endif
</x-guest-layout>
