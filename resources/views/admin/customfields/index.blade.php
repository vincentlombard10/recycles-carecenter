<x-app-layout>
    <x-page-header>
        <h1>Custom Fields</h1>
    </x-page-header>
    <x-page-wrapper>
        <table class="table">
            <thead>
                <tr>
                    <th>Nom d'affichage</th>
                    <th>ID de champ</th>
                    <th>Type</th>
                    <th>Date de modification</th>
                    <th>Réponse API</th>
                </tr>
            </thead>
            <tbody>
            @foreach($customfields as $cf)
                <tr>
                    <td><a href="{{ route('customfields.edit', $cf) }}">{{ $cf->name }}</a></td>
                    <td>{{ $cf->id }}</td>
                    <td>{{ $cf->type }}</td>
                    <td>{{ $cf->updated_at }}</td>
                    <td>/api/v1/custom-fields/{{ $cf->id }}</td>
                    <td><a href="/api/v1/custom-fields/{{ $cf->id }}">Editer</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </x-page-wrapper>
</x-app-layout>
