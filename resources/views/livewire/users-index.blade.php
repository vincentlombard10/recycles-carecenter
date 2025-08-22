<div>
    <table class="table">
        <thead>
        <tr>
            <th>User</th>
            <th>Email</th>
            <th>Role</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td class="ps-4 pe-2 py-3">{{ $user->name }}</td>
                <td class="px-2 py-3">{{ $user->email }}</td>
                <td class="px-2 py-3">
                    @foreach($user->roles as $role)
                        <span>{{ $role->name }}</span>
                    @endforeach
                </td>
                <td class="ps-2 pe-3 py-3" style="width: 8rem;">
                    <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-outline-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            Actions
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item text-end" href="{{ route('admin.users.edit', $user) }}">Editer<i class="bi bi-eye ms-2"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
