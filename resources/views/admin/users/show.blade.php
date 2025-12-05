<x-app-layout>
    <x-page-header>
        <h1 class="m-0">User</h1>
    </x-page-header>
    <x-page-wrapper>
        <div class="card">
            <div class="card-body">
                <div class="mb-3">
                    <ul>
                        <li>Identifiant : {{ $user->username }}</li>
                        <li>Nom : {{ $user->name }}</li>
                        <li>Créé le : {{ date('d/m/Y à H:i', strtotime($user->created_at)) }}</li>
                        <li>Dernière modification le : {{ date('d/m/Y à H:i', strtotime($user->updated_at)) }}</li>
                        <li>Adresse de connexion : {{ $user->email }}</li>
                        <li>Dernière connexion : {{ $user->last_login_at ? date('d/m/Y à H:i', strtotime($user->last_login_at)) : '-' }}</li>
                    </ul>
                </div>
                <div class="mb-3">
                    <a href="">Envoyer une invitation par e-mail</a>
                </div>
            </div>
        </div>
    </x-page-wrapper>
</x-app-layout>
