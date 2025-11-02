<x-app-layout>
    <x-messages />
    <x-page-wrapper>
        <div class="container-fluid p-3">
            <h1 class="mb-3">Modifier le mot de passe de connexion</h1>
            <div class="row">
                <div class="col-lg-6 mb-3">
                    <div class="alert">
                        <small>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Autem delectus dolor dolorum eos fuga in magni optio ratione velit voluptas. Beatae consequuntur cupiditate error ipsa iusto nemo sequi suscipit voluptas.</small>
                    </div>
                </div>
            </div>
            {{ html()->form('PUT', route('profile.password.update'))->open() }}
            @if ($errors->any())
                <ul style="color: red;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
            <div class="row">
                <div class="col-lg-6 mb-3">
                    <label for="current_password" class="form-label mb-1">Mot de passe actuel</label>
                    <input type="password" name="current_password" id="current_password" class="form-control">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 mb-3">
                    <label for="new_password" class="form-label mb-1">Nouveau mot de passe</label>
                    <input type="password" name="new_password" id="new_password" class="form-control">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 mb-3">
                    <label for="new_assword_confirmation" class="form-label mb-1">Confirmation du nouveau mot de psse</label>
                    <input type="password" name="new_password_confirmation" id="new_password_confirmation" class="form-control">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <input type="submit" class="btn btn-primary" value="Valider">
                </div>
            </div>
            {{ html()->form()->close() }}
        </div>
    </x-page-wrapper>
</x-app-layout>
