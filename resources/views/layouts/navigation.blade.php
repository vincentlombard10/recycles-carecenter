<div class="sidebar">
    <div class="sidebar-brand"></div>
    <ul class="sidebar-menu">
        {{ auth()->user()->name }}
        {{ auth()->user()->permissions_count }}
        @can('tickets.read')
        <li class="sidebar-item">
            <a href="{{ route('support.tickets.index') }}"
               class="sidebar-link {{ Route::is('support.tickets.*') ? 'active': '' }}"><i
                    class="bi bi-inboxes-fill"></i>&nbsp;<span class="sidebar-link__label">Tickets</span></a>
        </li>
        @endcan
        @canany(['returns.read', 'returns.create', 'returns.update', 'returns.delete'])
            <li class="sidebar-item">
                <a href="{{ route('support.returns.index') }}"
                   class="sidebar-link {{ Route::is('support.returns.*') ? 'active': '' }}"><i
                        class="bi bi-box-fill"></i>&nbsp;<span class="sidebar-link__label">Retours</span></a>
            </li>
        @endcanany
        @canany(['reports.read', 'reports.create', 'reports.update', 'reports.delete'])
            <li class="sidebar-item">
                <a href="{{ route('support.reports.index') }}"
                   class="sidebar-link {{ Route::is('support.reports.*') ? 'active': '' }}"><i
                        class="bi bi-list-check"></i>&nbsp;<span
                        class="sidebar-link__label">Rapports</span></a>
            </li>
        @endcanany
    </ul>
    <ul class="sidebar-menu">
        <li class="sidebar-item">
            <a href="{{ route('customfields.index') }}"
               class="sidebar-link {{ Route::is('customfields.*') ? 'active': '' }}">Custom Fields</a>
        </li>
    </ul>
    @hasanyrole('superadmin')
    <ul class="sidebar-menu">
        <li class="sidebar-item">
            <a href="{{ route('brands.index') }}"
               class="sidebar-link {{ Route::is('brands.*') ? 'active': '' }}"><i class="bi bi-tag-fill"></i>&nbsp;<span
                    class="sidebar-link__label">Marques</span></a>
        </li>
        <li class="sidebar-item">
            <a href="{{ route('groups.index') }}"
               class="sidebar-link {{ Route::is('groups.*') ? 'active': '' }}"><i
                    class="bi bi-grid-fill"></i>&nbsp;<span class="sidebar-link__label">Groupes</span></a>
        </li>
        <li class="sidebar-item">
            <a href="{{ route('serials.index') }}"
               class="sidebar-link {{ Route::is('serials.*') ? 'active': '' }}"><i class="bi bi-upc"></i>&nbsp;<span
                    class="sidebar-link__label">Numéros de série</span></a>
        </li>
        <li class="sidebar-item">
            <a href="{{ route('items.index') }}"
               class="sidebar-link {{ Route::is('items.*') ? 'active': '' }}"><i class="bi bi-bicycle"></i>&nbsp;<span
                    class="sidebar-link__label">Références</span></a>
        </li>
        <li class="sidebar-item">
            <a href="{{ route('contacts.index') }}"
               class="sidebar-link {{ Route::is('contacts.*') ? 'active': '' }}"><i class="bi bi-person-lines-fill"></i>&nbsp;<span
                    class="sidebar-link__label">Contacts</span></a>
        </li>
    </ul>
    @endhasanyrole
    <ul class="sidebar-menu mt-auto mb-0">
        <li class="sidebar-item">
            {{ html()->form('POST', route('logout'))->open() }}
            <button class="sidebar-link sidebar-link--logout"><i class="bi bi-person-lines-fill"></i>&nbsp;<span
                    class="sidebar-link__label">Déconnexion</span></button>
            {{ html()->form()->close() }}
        </li>
    </ul>
</div>
