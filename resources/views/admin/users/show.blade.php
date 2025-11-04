<x-app-layout>
    <x-page-header>
        <h1>User</h1>
    </x-page-header>
    <x-page-wrapper>
        <div class="card">
            <div class="card-body">
                <ul>
                    <li>Identifiant : {{ $user->username }}</li>
                    <li>Nom : {{ $user->name }}</li>
                    <li>Adresse de connexion : {{ $user->email }}</li>
                    <li>Dernière connexion le : {{ $user->last_login_at }}</li>
                </ul>
            </div>
        </div>
    </x-page-wrapper>
</x-app-layout>
