<x-app-layout>
    <x-page-header>
        <div class="page-header-content">
            <div class="d-flex align-items-center gap-3">
                <a href="{{ route('changelogs.index') }}" class="btn btn-circle btn-orange">
                    <i class="bi bi-arrow-left"></i>
                </a>
                <h1>Nouveau ChangeLog</h1>
            </div>
            <div>

            </div>
        </div>
    </x-page-header>
    <x-page-wrapper>
        <div class="container-fluid p-5">
            {{ html()->form('POST', '#')->open() }}
            <div class="mb-3">
                <label for="title" class="form-label mb-1">Titre</label>
                <input type="text" name="title" class="form-control">
            </div>
            <div>
                <label for="content" class="form-label mb-1">Contenu</label>
                <textarea name="content" id="" cols="30" rows="10"></textarea>
            </div>
            {{ html()->form()->close() }}
        </div>
    </x-page-wrapper>
</x-app-layout>
