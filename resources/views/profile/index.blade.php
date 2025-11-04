<x-app-layout>
    <x-page-header>
        <div class="page-header-content">
            <div class="d-flex align-items-center gap-3">
                <h1>Mon profil</h1>
            </div>
            <div class="d-flex align-items-center gap-3">
                :)
            </div>
        </div>
    </x-page-header>
    <x-page-wrapper>
        <div class="container-fluid p-3">
            <div class="row mb-3">
                <div class="col-12 mb-3">
                    <ul>
                        <li><span class="fw-semibold">Nom et prénom :</span> {{ auth()->user()->name }}</li>
                        <li><span class="fw-semibold">Adresse de connexion :</span> {{ auth()->user()->email }}</li>
                    </ul>
                </div>
                <div class="col-12 mb-3">
                    <a href="{{ route('profile.password.change') }}">Modifier mon mot de passe de connexion</a>
                </div>
            </div>
        </div>
    </x-page-wrapper>
</x-app-layout>
