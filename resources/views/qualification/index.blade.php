<x-app-layout>
    <x-page-header>
        <div class="page-header-content">
            <div>
                <h1>Qualifications</h1>
            </div>
            <div class="d-flex align-content-center gap-2">
                <a href="{{ route('qualifications.create') }}" class="btn btn-circle btn-violet"><i class="bi bi-plus-lg"></i></a>
                <livewire:search-form />
            </div>
        </div>
    </x-page-header>
    <x-page-wrapper>
        <x-messages />
        <table class="table">
            <tbody>
            @foreach($qualifications as $qualification)
                <tr>
                    <td>{{ $qualification->id }}</td>
                    <td>
                        <div>{{ $qualification->name }}</div>
                        <div>{{ $qualification->description }}</div>
                    </td>
                    <td>
                        <a href="{{ route('qualifications.edit', $qualification) }}">Editer</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </x-page-wrapper>
</x-app-layout>
