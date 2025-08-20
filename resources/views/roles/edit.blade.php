<x-app-layout>
    <x-page-header>
        <h1>Rôles</h1>
    </x-page-header>
    <x-page-wrapper>
        <div class="card">
            <div class="card-body p-5">
                <h2>{{ $role->name }}</h2>
                {{ html()->form('PATCH', route('admin.roles.update', $role))->open() }}
                <div>
                    @foreach($rootPermissions as $permission)
                        <div class="mb-5">
                            <h4>{{ __('permissions.' . $permission->name) }}</h4>
                            <ul class="list-group">
                                @foreach($permission->children as $permission)
                                    <li class="list-group-item">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="permission[]" value="{{ $permission->name }}" id="permission-{{ $permission->id }}" {{ in_array($permission->id, $usedPermissions, true) ? 'checked': '' }}>
                                            <label for="permission-{{ $permission->id }}" class="form-check-label">{{ __('permissions.' . $permission->name) }}</label>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endforeach
                </div>
                {{ html()->submit('update')->class('btn btn-primary') }}
                {{ html()->form()->close() }}
            </div>
        </div>
    </x-page-wrapper>
</x-app-layout>
