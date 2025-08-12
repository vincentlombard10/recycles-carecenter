<td class="p-2" style="width: 10rem;">
    <div class="d-grid gap-2">
        <span class="badge status--{{ $item->status_color }}">{{ $item->status_label }}</span>
        <div class="btn-group">
            <button type="button" class="btn btn-sm btn-outline-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                Actions
            </button>
            <ul class="dropdown-menu dropdown-menu-end">
                <li>
                    <a class="dropdown-item text-end" href="{{ route('support.returns.show', $item->identifier) }}">Consulter</a>
                </li>
                <li>
                    <a class="dropdown-item text-end" href="{{ route('support.returns.edit', $item->identifier) }}">Editer</a>
                </li>
                <li>
                    <a class="dropdown-item text-end" href="{{ route('support.returns.download', $item->identifier) }}">Télécharger</a>
                </li>
                @if($item->trashed())
                    <li>
                        {{ html()->form('POST', route('support.returns.restore', $item))->open() }}
                        <a class="dropdown-item text-end" onclick="this.preventDefault();this.closest('form').submit();">Restaurer</a>
                        {{ html()->form()->close() }}
                    </li>
                    <li>
                        {{ html()->form('DELETE', route('support.returns.forceDelete', $item))->open() }}
                        <a class="dropdown-item text-end" onclick="this.preventDefault();this.closest('form').submit();">Supprimer définitivement</a>
                        {{ html()->form()->close() }}
                    </li>
                @else
                <li>
                    {{ html()->form('DELETE', route('support.returns.destroy', $item))->open() }}
                    <a class="dropdown-item text-end" onclick="this.preventDefault();this.closest('form').submit();">Supprimer</a>
                    {{ html()->form()->close() }}
                </li>
                @endif
            </ul>
        </div>
    </div>
</td>
