<div class="fixed bg-white w-16 z-50 overflow-visible h-screen top-0">
    <div class="bg-violet-200 h-16 flex justify-center items-center">
        <span class="font-bold uppercase text-2xl text-orange-500"></span>
    </div>
    <div class="h-[calc(100vh-4rem)] scroll-auto py-2 flex flex-col gap-1">
        <ul class="flex flex-col items-center gap-1">
            <li class="w-10 rounded">
                <a href="{{ route('profile.index') }}"
                   class="group inline-flex gap-2 items-center text-violet-900">
                    <div class="flex w-10 h-10 justify-center items-center rounded-md [:not(.active)]:hover:text-orange-500 [:not(.active)]:hover:bg-orange-50 {{ Route::is('profile.*') ? 'active bg-violet-100 text-violet-950' : '' }}">
                        <i class="bi bi-person-badge"></i>
                    </div>
                    <div class="hidden h-8 w-128 px-4 items-center font-semibold group-hover:flex">
                        <span class="flex items-center bg-white px-4 h-8 shadow-xl rounded-full">Mon profil</span>
                    </div>
                </a>
            </li>
        </ul>
        <ul class="flex flex-col items-center gap-1">
            <li class="w-10">
                <a href="{{ route('dashboard') }}"
                   class="group inline-flex gap-2 items-center text-violet-900">
                    <div class="flex w-10 h-10 justify-center items-center rounded-md [:not(.active)]:hover:text-orange-500 [:not(.active)]:hover:bg-orange-50 {{ Route::is('dashboard') ? 'active bg-violet-100 text-violet-950' : '' }}">
                        <x-heroicon-o-home class="w-4.5 h-4.5" stroke-width="1.5"/>
                    </div>
                    <div class="hidden h-8 w-128 px-4 items-center font-semibold group-hover:flex">
                        <span class="flex items-center bg-white px-4 h-8 shadow-xl rounded-full">Tableau de bord</span>
                    </div>
                </a>
            </li>
            @canany(['returns.read', 'returns.create', 'returns.update', 'returns.delete'])
                <li class="relative w-10">
                    <a href="{{ route('support.returns.index') }}"
                       class="group inline-flex gap-2 items-center text-violet-900">
                        <div class="flex w-10 h-10 justify-center items-center rounded-md [:not(.active)]:hover:text-orange-500 [:not(.active)]:hover:bg-orange-50 {{ Route::is('support.returns.*') ? 'active bg-violet-100 text-violet-950' : '' }}">
                            <x-heroicon-o-cube class="w-4.5 h-4.5" stroke-width="1.5"/>
                        </div>
                        <div class="hidden h-8 w-128 px-4 items-center font-semibold group-hover:flex">
                            <span
                                class="flex items-center bg-white px-4 h-8 shadow-xl rounded-full">Retours produits</span>
                        </div>
                    </a>
                    @if($productReturnsPendingCount)
                        <div class="absolute w-4.5 h-4.5 bg-linear-to-r/oklch from-pink-500 via-rose-500 to-red-500 rounded-xl top-[-3px] right-[-3px] flex items-center justify-center">
                            <span class="text-xs text-white font-semibold">{{ $productReturnsPendingCount }}</span>
                        </div>
                    @endif
                </li>
            @endcanany
            @canany(['reports.read', 'reports.create', 'reports.update', 'reports.delete'])
                <li class="w-10 relative">
                    <a href="{{ route('support.reports.index') }}"
                       class="group inline-flex gap-2 items-center text-violet-900">
                        <div class="flex w-10 h-10 justify-center items-center rounded-md [:not(.active)]:hover:text-orange-500 [:not(.active)]:hover:bg-orange-50 {{ Route::is('support.reports.*') ? 'active bg-violet-100 text-violet-950' : '' }}">
                            <x-heroicon-o-clipboard-document-check class="w-4.5 h-4.5" stroke-width="1.5"/>
                        </div>
                        <div class="hidden h-8 w-128 px-4 items-center font-semibold group-hover:flex">
                            <span class="flex items-center bg-white px-4 h-8 shadow-xl rounded-full">Rapports d'intervention</span>
                        </div>
                    </a>
                    @if($productReportsInProgressCount)
                    <div class="absolute w-4.5 h-4.5 bg-linear-to-r/oklch from-pink-500 via-rose-500 to-red-500 rounded-xl top-[-3px] right-[-3px] flex items-center justify-center">
                        <span class="text-xs text-white font-semibold">{{ $productReportsInProgressCount }}</span>
                    </div>
                    @endif
                </li>
            @endcanany
            @canany(['reports.read', 'reports.create', 'reports.update', 'reports.delete'])
                <li class="relative w-10">
                    <a href="{{ route('support.estimates.index') }}"
                       class="group inline-flex gap-2 items-center text-violet-900">
                        <div class="flex w-10 h-10 justify-center items-center rounded-md [:not(.active)]:hover:text-orange-500 [:not(.active)]:hover:bg-orange-50 {{ Route::is('support.estimates.*') ? 'active bg-violet-100 text-violet-950' : '' }}">
                            <x-heroicon-o-document-currency-euro class="w-4.5 h-4.5" stroke-width="1.5"/>
                        </div>
                        <div class="hidden h-8 w-128 px-4 items-center font-semibold group-hover:flex">
                            <span class="flex items-center bg-white px-4 h-8 shadow-xl rounded-full">Devis</span>
                        </div>
                    </a>
                    @if($estimatesPendingCount)
                        <div class="absolute w-4.5 h-4.5 bg-linear-to-r/oklch from-pink-500 via-rose-500 to-red-500 rounded-xl top-[-3px] right-[-3px] flex items-center justify-center">
                            <span class="text-xs text-white font-semibold">{{ $estimatesPendingCount }}</span>
                        </div>
                    @endif
                </li>
            @endcanany
            @canany('tickets.read')
                <li class="w-10">
                    <a href="{{ route('support.tickets.index') }}"
                       class="group inline-flex gap-2 items-center text-violet-900">
                        <div class="flex w-10 h-10 justify-center items-center rounded-md [:not(.active)]:hover:text-orange-500 [:not(.active)]:hover:bg-orange-50 {{ Route::is('support.tickets.*') ? 'active bg-violet-100 text-violet-950' : '' }}">
                            <x-heroicon-o-inbox-stack class="w-4.5 h-4.5" stroke-width="1.5"/>
                        </div>
                        <div class="hidden h-8 w-128 px-4 items-center font-semibold group-hover:flex">
                            <span class="flex items-center bg-white px-4 h-8 shadow-xl rounded-full">Tickets Zendesk Support</span>
                        </div>
                    </a>
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
        <ul class="flex flex-col items-center gap-1">
            @canany('brands.read')
                <li class="w-10">
                    <a href="{{ route('brands.index') }}"
                       class="group inline-flex gap-2 items-center text-violet-900">
                        <div class="flex w-10 h-10 justify-center items-center rounded-md [:not(.active)]:hover:text-orange-500 [:not(.active)]:hover:bg-orange-50 {{ Route::is('brands.*') ? 'active bg-violet-100 text-violet-950' : '' }}">
                            <x-heroicon-o-tag class="w-4.5 h-4.5" stroke-width="1.5"/>
                        </div>
                        <div class="hidden h-8 w-128 px-4 items-center font-semibold group-hover:flex">
                            <span class="flex items-center bg-white px-4 h-8 shadow-xl rounded-full">Marques</span>
                        </div>
                    </a>
                </li>
            @endcanany
            @canany('groups.read')
                <li class="w-10">
                    <a href="{{ route('groups.index') }}"
                       class="group inline-flex gap-2 items-center text-violet-900">
                        <div class="flex w-10 h-10 justify-center items-center rounded-md [:not(.active)]:hover:text-orange-500 [:not(.active)]:hover:bg-orange-50 {{ Route::is('groups.*') ? 'active bg-violet-100 text-violet-950' : '' }}">
                            <x-heroicon-o-squares-2x2 class="w-4.5 h-4.5" stroke-width="1.5"/>
                        </div>
                        <div class="hidden h-8 w-128 px-4 items-center font-semibold group-hover:flex">
                            <span
                                class="flex items-center bg-white px-4 h-8 shadow-xl rounded-full">Groupes produits</span>
                        </div>
                    </a>
                </li>
            @endcanany
            @canany('serials.read')
                <li class="w-10">
                    <a href="{{ route('serials.index') }}"
                       class="group inline-flex gap-2 items-center text-violet-900">
                        <div class="flex w-10 h-10 justify-center items-center rounded-md [:not(.active)]:hover:text-orange-500 [:not(.active)]:hover:bg-orange-50 {{ Route::is('serials.*') ? 'active bg-violet-100 text-violet-950' : '' }}">
                            <x-heroicon-o-qr-code class="w-4.5 h-4.5" stroke-width="1.5"/>
                        </div>
                        <div class="hidden h-8 w-128 px-4 items-center font-semibold group-hover:flex">
                            <span
                                class="flex items-center bg-white px-4 h-8 shadow-xl rounded-full">Numéros de série</span>
                        </div>
                    </a>
                </li>
            @endcanany
            @canany('items.read')
                <li class="w-10">
                    <a href="{{ route('items.index') }}"
                       class="group inline-flex gap-2 items-center text-violet-900">
                        <div class="flex w-10 h-10 justify-center items-center rounded-md [:not(.active)]:hover:text-orange-500 [:not(.active)]:hover:bg-orange-50 {{ Route::is('items.*') ? 'active bg-violet-100 text-violet-950' : '' }}">
                            <x-heroicon-o-square-3-stack-3d class="w-4.5 h-4.5" stroke-width="1.5"/>
                        </div>
                        <div class="hidden h-8 w-128 px-4 items-center font-semibold group-hover:flex">
                            <span
                                class="flex items-center bg-white px-4 h-8 shadow-xl rounded-full">Références produits</span>
                        </div>
                    </a>
                </li>
            @endcanany
            @canany('items.read')
                    <li class="w-10">
                        <a href="{{ route('contacts.index') }}"
                           class="group inline-flex gap-2 items-center text-violet-900">
                            <div class="flex w-10 h-10 justify-center items-center rounded-md [:not(.active)]:hover:text-orange-500 [:not(.active)]:hover:bg-orange-50 {{ Route::is('contacts.*') ? 'active bg-violet-100 text-violet-950' : '' }}">
                                <x-heroicon-o-user-circle class="w-4.5 h-4.5" stroke-width="1.5"/>
                            </div>
                            <div class="hidden h-8 w-128 px-4 items-center font-semibold group-hover:flex">
                            <span
                                class="flex items-center bg-white px-4 h-8 shadow-xl rounded-full">Contacts clients</span>
                            </div>
                        </a>
                    </li>
            @endcanany
        </ul>
        @hasanyrole('admin|superadmin')
        <ul class="flex flex-col items-center gap-1">
            <li class="w-10">
                <a href="{{ route('admin.users.index') }}"
                   class="group inline-flex gap-2 items-center text-violet-900">
                    <div class="flex w-10 h-10 justify-center items-center rounded-md [:not(.active)]:hover:text-orange-500 [:not(.active)]:hover:bg-orange-50 {{ Route::is('admin.users.*') ? 'active bg-violet-100 text-violet-950' : '' }}">
                        <x-heroicon-o-user class="w-4.5 h-4.5" stroke-width="1.5"/>
                    </div>
                    <div class="hidden h-8 w-128 px-4 items-center font-semibold group-hover:flex">
                            <span
                                class="flex items-center bg-white px-4 h-8 shadow-xl rounded-full">Utilisateurs</span>
                    </div>
                </a>
            </li>
            <li class="w-10">
                <a href="{{ route('admin.roles.index') }}"
                   class="group inline-flex gap-2 items-center text-violet-900">
                    <div class="flex w-10 h-10 justify-center items-center rounded-md [:not(.active)]:hover:text-orange-500 [:not(.active)]:hover:bg-orange-50 {{ Route::is('admin.roles.*') ? 'active bg-violet-100 text-violet-950' : '' }}">
                        <x-heroicon-o-users class="w-4.5 h-4.5" stroke-width="1.5"/>
                    </div>
                    <div class="hidden h-8 w-128 px-4 items-center font-semibold group-hover:flex">
                            <span
                                class="flex items-center bg-white px-4 h-8 shadow-xl rounded-full">Rôles</span>
                    </div>
                </a>
            </li>
        </ul>
        @endhasanyrole
    </div>
</div>
