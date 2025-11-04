<div class="sidebar">
    <div class="sidebar-brand">Care Center</div>
    <div class="sidebar-content">
        <ul class="sidebar-menu">
            <li class="sidebar-item">
                <a href="{{ route('profile.index') }}" class="sidebar-link {{ Route::is('profile.*') ? 'active': '' }}">
                    <i class="bi bi-person-badge"></i>
                    <span class="sidebar-link__label">Mon profil</span>
                </a>
            </li>
        </ul>
        <ul class="sidebar-menu">
            <li class="sidebar-item">
                <a href="{{ route('dashboard') }}"
                   class="sidebar-link {{ Route::is('dashboard') ? 'active': '' }}"><i
                        class="bi bi-house"></i><span class="sidebar-link__label">Tableau de bord</span></a>
            </li>
            @canany(['returns.read', 'returns.create', 'returns.update', 'returns.delete'])
                <li class="sidebar-item">
                    <a href="{{ route('support.returns.index') }}"
                       class="sidebar-link {{ Route::is('support.returns.*') ? 'active': '' }}"><i
                            class="bi bi-box"></i><span class="sidebar-link__label">Retours produits</span></a>
                </li>
            @endcanany
            @canany(['reports.read', 'reports.create', 'reports.update', 'reports.delete'])
                <li class="sidebar-item">
                    <a href="{{ route('support.reports.index') }}"
                       class="sidebar-link {{ Route::is('support.reports.*') ? 'active': '' }}"><i
                            class="bi bi-list-check"></i><span
                            class="sidebar-link__label">Rapports d'expertise</span></a>
                </li>
            @endcanany
            @canany('tickets.read')
                <li class="sidebar-item">
                    <a href="{{ route('support.tickets.index') }}"
                       class="sidebar-link {{ Route::is('support.tickets.*') ? 'active': '' }}"><i
                            class="bi bi-inboxes"></i><span class="sidebar-link__label">Tickets Zendesk</span></a>
                </li>
            @endcanany
{{--            <li class="sidebar-item">
                <a href="#"
                   class="sidebar-link">
                    <i class="bi bi-card-list"></i>
                    <span class="sidebar-link__label">Nomenclatures</span>
                </a>
            </li>--}}
        </ul>
        <ul class="sidebar-menu">
            @canany('brands.read')
                <li class="sidebar-item">
                    <a href="{{ route('brands.index') }}"
                       class="sidebar-link {{ Route::is('brands.*') ? 'active': '' }}"><i class="bi bi-tag"></i><span
                            class="sidebar-link__label">Marques</span></a>
                </li>
            @endcanany
            @canany('groups.read')
                <li class="sidebar-item">
                    <a href="{{ route('groups.index') }}"
                       class="sidebar-link {{ Route::is('groups.*') ? 'active': '' }}"><i
                            class="bi bi-grid"></i><span class="sidebar-link__label">Groupes</span></a>
                </li>
            @endcanany
            @canany('serials.read')
                <li class="sidebar-item">
                    <a href="{{ route('serials.index') }}"
                       class="sidebar-link {{ Route::is('serials.*') ? 'active': '' }}"><i class="bi bi-upc"></i><span
                            class="sidebar-link__label">Numéros de série</span></a>
                </li>
            @endcanany
            @canany('items.read')
                <li class="sidebar-item">
                    <a href="{{ route('items.index') }}"
                       class="sidebar-link {{ Route::is('items.*') ? 'active': '' }}"><i class="bi bi-bicycle"></i><span
                            class="sidebar-link__label">Références</span></a>
                </li>
            @endcanany
            @canany('items.read')
                <li class="sidebar-item">
                    <a href="{{ route('contacts.index') }}"
                       class="sidebar-link {{ Route::is('contacts.*') ? 'active': '' }}"><i
                            class="bi bi-person"></i><span
                            class="sidebar-link__label">Contacts</span></a>
                </li>
            @endcanany
        </ul>
        @hasanyrole('superadmin')
        <ul class="sidebar-menu">
            <li class="sidebar-item">
                <a href="{{ route('admin.users.index') }}"
                   class="sidebar-link {{ Route::is('admin.users.*') ? 'active': '' }}"><i
                        class="bi bi-person-fill"></i><span
                        class="sidebar-link__label">Utilisateurs</span></a>
            </li>
            <li class="sidebar-item">
                <a href="{{ route('admin.roles.index') }}"
                   class="sidebar-link {{ Route::is('admin.roles.*') ? 'active': '' }}"><i
                        class="bi bi-people-fill"></i><span
                        class="sidebar-link__label">Rôles</span></a>
            </li>
            <li class="sidebar-item">
                <a href="{{ route('log-viewer.index') }}"
                   class="sidebar-link {{ Route::is('log-viewer.*') ? 'active': '' }}"><i
                        class="bi bi-journal-text"></i><span
                        class="sidebar-link__label">Visualiseur de logs</span></a>
            </li>
        </ul>
        @endhasanyrole
        <ul class="sidebar-menu mt-auto mb-0">
            <li class="sidebar-item">
                {{ html()->form('POST', route('logout'))->open() }}
                <button class="sidebar-link sidebar-link--logout"><i class="bi bi-person-lines-fill"></i><span
                        class="sidebar-link__label">Déconnexion</span></button>
                {{ html()->form()->close() }}
            </li>
        </ul>
    </div>
</div>
