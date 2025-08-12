<x-guest-layout>
    {{ html()->form('POST', route('login'))->open() }}
        <div class="mb-3">
            {{ html()->label('Adresse e-mail :')->class('form-label') }}
            {{ html()->email('email')->class('form-control focus-ring focus-ring-light')->autocomplete('off') }}
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>
        <div class="mb-3">
            {{ html()->label('Mot de passe :')->class('form-label') }}
            {{ html()->password('password')->class('form-control focus-ring focus-ring-light')->autocomplete('current-password') }}
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>
        <div class="d-grid gap-2">
            {{ html()->submit('Connexion')->class('btn btn-primary ') }}
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                    {{ __('Mot de passe oublié ?') }}
                </a>
            @endif
        </div>
    {{ html()->form()->close() }}
</x-guest-layout>
