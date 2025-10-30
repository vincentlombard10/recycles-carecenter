<td class="p-2" style="width: 10rem;">
    <div class="d-grid gap-2">
        <span class="badge status--{{ $item->status_color }}">{{ $item->status_label }}</span>
        <div class="btn-group">
            <button type="button" class="btn btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                Actions
            </button>
            <ul class="dropdown-menu dropdown-menu-end">
                <li>
                    <a class="dropdown-item text-end" href="{{ route('support.returns.show', $item->identifier) }}">Consulter<i class="bi bi-eye ms-2"></i>
                    </a>
                </li>
                @canany(['returns.update', 'returns.edit'])
                <li><a class="dropdown-item text-end" href="{{ route('support.returns.edit', $item->identifier) }}">Editer<i class="bi bi-pencil-square ms-2"></i></a></li>
                <li><a class="dropdown-item text-end" href="{{ route('support.returns.edit', $item->identifier) }}">Réceptionner<i class="bi bi-pencil-square ms-2"></i></a></li>
                @endcanany
                <li>
                    <a class="dropdown-item text-end" href="{{ route('support.returns.download', $item->identifier) }}">Télécharger<i class="bi bi-download ms-2"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</td>
