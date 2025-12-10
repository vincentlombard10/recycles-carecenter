<x-guest-layout>
    {{ html()->form('POST', route('login'))->open() }}
    <div class="mb-3">
        {{ html()->label('Adresse e-mail :')->for('email')->class('inline-block font-semibold mb-1') }}
        {{ html()->email('email')->class('px-4 py-2 w-full bg-white rounded border-1 border-violet-300 ring-0')->autocomplete('off') }}
    </div>
    <div class="mb-3">
        {{ html()->label('Mot de passe :')->for('password')->class('inline-block font-semibold mb-1') }}
        {{ html()->password('password')->class('px-4 py-2 w-full bg-white rounded border-1 border-violet-300')->autocomplete('current-password') }}
    </div>
    <div class="d-grid mb-3">
        {{ html()->submit('Connexion')->class('bg-violet-600 w-full py-2 rounded text-white font-bold hover:bg-violet-700') }}
    </div>
    <div>
        @if (Route::has('password.request'))
            <a class="font-semibold"
               href="{{ route('password.request') }}">
                {{ __('Mot de passe oublié ?') }}
            </a>
        @endif
    </div>
    {{ html()->form()->close() }}

    @if ($errors->any())
        <div id="login-bottom-banner">
            @foreach($errors->all() as $e)
                <li>{{ $e }}</li>
            @endforeach
        </div>
    @endif

</x-guest-layout>
