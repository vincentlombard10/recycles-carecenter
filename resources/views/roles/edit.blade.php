<x-app-layout>
    <x-page-header>
        <h1 class="m-0">Rôles</h1>
    </x-page-header>
    <x-page-wrapper>
        <div class="card">
            <div class="card-body p-5">
                <h2 class="font-bold text-2xl mb-3">{{ $role->public_name }}</h2>
                {{ html()->form('PATCH', route('admin.roles.update', $role))->open() }}
                <div class="grid grid-cols-4 gap-2">
                    @foreach($rootPermissions as $permission)
                        <div class="bg-white rounded px-6 py-4">
                            <h4 class="font-semibold text-xl mb-3">{{ __('permissions.' . $permission->name) }}</h4>
                            @forelse($permission->children as $permission)
                                <div class="flex gap-2 items-center mb-1">
                                    <input class="w-5 h-5 cursor-pointer" type="checkbox" name="permission[]"
                                           value="{{ $permission->name }}"
                                           id="permission-{{ $permission->id }}" {{ in_array($permission->id, $usedPermissions, true) ? 'checked': '' }}>
                                    <label for="permission-{{ $permission->id }}"
                                           class="form-check-label">{{ __('permissions.' . $permission->name) }}</label>
                                </div>
                            @empty
                            @endforelse
                        </div>
                    @endforeach
                </div>
                {{ html()->submit('update')->class('btn btn-primary') }}
                {{ html()->form()->close() }}
            </div>
        </div>
    </x-page-wrapper>
</x-app-layout>
