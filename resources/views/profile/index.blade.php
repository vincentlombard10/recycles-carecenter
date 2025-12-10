<x-app-layout>
    <x-page-header>
        <div class="flex justify-between items-center w-full">
            <h1 class="m-0">Mon profil</h1>
        </div>
    </x-page-header>
    <x-page-wrapper>
        <div class="bg-white p-6 rounded mb-3">
            <h2 class="font-bold text-xl mb-3">Général</h2>
            <div class="mb-3">
                <ul>
                    <li><span class="fw-semibold">Nom et prénom :</span> {{ auth()->user()->name }}</li>
                    <li><span class="fw-semibold">Adresse de connexion :</span> {{ auth()->user()->email }}</li>
                </ul>
            </div>
            <div>
                <a href="{{ route('profile.password.change') }}">Modifier mon mot de passe de connexion</a>
            </div>
        </div>
{{--        <div class="bg-white p-6 mb-3">
            <h2 class="font-bold text-xl mb-3">Préférences</h2>
            {{ html()->form('PUT', route('profile.preferences.update'))->open() }}
            <div class="flex gap-2 items-center mb-3">
                <input type="checkbox" id="show_badges" value="1" class="w-5 h-5" name="show_badges" {{ auth()->user()->preference('show_badges') ? 'checked' : '' }}>
                <label for="show_badges">Afficher les pastilles dans le menu</label>
            </div>
            <div>
                <input type="submit" class="bg-violet-700 px-4 py-2 text-white font-semibold rounded" value="Enregistrer mes préférences">
            </div>
            {{ html()->form()->close() }}
        </div>--}}
    </x-page-wrapper>
</x-app-layout>
