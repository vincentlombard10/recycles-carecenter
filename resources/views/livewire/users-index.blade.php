<div>
    <table class="table">
        <tbody>
        @foreach($users as $user)
            <tr>
                <td class="ps-4 pe-2 py-3"><span class="fw-bold">{{ $user->username }}</span></td>
                <td class="px-2 py-3">{{ $user->lastname }}</td>
                <td class="px-2 py-3">{{ $user->firstname }}</td>
                <td class="px-2 py-3">{{ $user->email }}</td>
                <td class="px-2 py-3">
                    @foreach($user->roles as $role)
                        <span class="badge">{{ $role->public_name }}</span>
                    @endforeach
                </td>
                <td class="ps-2 pe-3 py-3" style="width: 8rem;">
                    <div class="btn-group">
                        <button type="button" class="btn btn-light dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
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
