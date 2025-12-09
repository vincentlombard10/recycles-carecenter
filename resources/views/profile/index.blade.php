<x-app-layout>
    <x-page-header>
        <div class="flex justify-between items-center w-full">
            <h1 class="m-0">Mon profil</h1>
        </div>
    </x-page-header>
    <x-page-wrapper>
        <div class="bg-white px-6 py-4 rounded">
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
        </div>
    </x-page-wrapper>
</x-app-layout>
