<x-guest-layout>
    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div class="mb-3">
            <label for="email" class="form-label mb-1">Adresse e-mail</label>
            <input type="text" class="form-control" name="email" value="{{ old('email', $request->email) }}" required autofocus>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mb-3">
            <label for="password" class="form-label mb-1">Nouveau mot de passe</label>
            <input type="password" name="password" class="form-control" required>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirmation du mot de passe :</label>
            <input type="password" name="password_confirmation" class="form-control" required>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="d-grid">
            <input type="submit" value="Réinitiailiser le mot de passe" class="btn btn-primary">
        </div>
    </form>
</x-guest-layout>
