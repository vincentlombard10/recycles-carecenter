<div>
    <table class="table">
        <tbody>
        @foreach($roles as $role)
            <tr>
                <td class="ps-4 pe-2 py-3">{{ $role->public_name }}</td>
                <td class="p-2" style="width: 10rem;">
                    <div class="d-grid gap-2">
                        <div class="btn-group">
                            <button type="button" class="btn btn-light dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                Actions
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item text-end" href="{{ route('admin.roles.edit', $role) }}">Editer<i class="bi bi-eye ms-2"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </td>

            </tr>
        @endforeach
        </tbody>
    </table>
</div>
