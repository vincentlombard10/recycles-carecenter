@props(['report' => null])
<div class="bg bg__{{ $report->status }} p-3 lg:p-4 mb-2 rounded-md">
    <div class="grid grid-cols-[auto_8rem] gap-4">
        <div class="grid md:grid-cols-[8rem_auto] gap-4">
            <div class="column-left">
                <h2 class="font-bold text-2xl mb-2">{{ $report->identifier }}</h2>
                <span
                    class="badge-small">{{ $report->return->environment }}</span>
                <span
                    class="badge-small">{{ $report->return->type_label }}</span>
                <span
                    class="badge-small">{{ $report->return->context_label }}</span>
                <span
                    class="badge-small">
                                        <div>{{ $report->return->ticket_id }}</div>
                                        @if($report->return->ticket?->contact)
                        <div><span
                                class="text-blue-800 font-bold">{{ $report->return->ticket?->contact->code }}</span></div>
                    @endif
                                    </span>
            </div>
            <div class="column-right grid grid-cols-2 gap-4">
                <div>
                    @if($report->return->type === 'bike')
                        <x-card-bike :item="$report->return"/>
                    @elseif($report->return->type === 'component')
                        <x-card-component :item="$report->return"/>
                    @elseif($report->return->type === 'battery')
                        <x-card-battery :item="$report->return"/>
                    @else
                        <div>Non défini</div>
                    @endif
                </div>
                <div>
                    @if($report->started_at)
                        <div class="">
                            <div class="text-xs">Technicien : {{ $report->technician?->username }}</div>
                            <div class="text-xs">Démarrage : {{ date('d/m/Y H:i', strtotime($report->started_at)) }}
                                - {{ $report->technician?->username }}</div>
                            @if($report->closed_at)
                            <div class="text-xs">Clôture : {{ date('d/m/Y H:i', strtotime($report->closed_at)) }}</div>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div>
            <div class="">
                <div
                    class="badge {{ $report->status }} w-full mb-2">{{ $report->status_label }}</div>
                <div>
                    <el-dropdown>
                        <button
                            role="button"
                            popovertarget="item-{{ $report->identifier }}"
                            class="inline-flex bg-violet-100 justify-center rounded-md w-full text-sm font-semibold text-gray-900 hover:bg-gray-50 py-2">
                            Actions
                            <svg viewBox="0 0 20 20" fill="currentColor" data-slot="icon" aria-hidden="true"
                                 class="-mr-1 size-5 text-gray-400">
                                <path
                                    d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z"
                                    clip-rule="evenodd" fill-rule="evenodd"/>
                            </svg>
                        </button>

                        <el-menu anchor="bottom end" id="item-{{ $report->identifier }}" popover
                                 class="w-32 origin-top-right rounded-md bg-white shadow-lg outline-1 outline-black/5 transition transition-discrete [--anchor-gap:--spacing(2)] data-closed:scale-95 data-closed:transform data-closed:opacity-0 data-enter:duration-100 data-enter:ease-out data-leave:duration-75 data-leave:ease-in">
                            <div class="py-0">
                                @if($report->isPending() || $report->isPaused())
                                    <button
                                        class="block px-4 py-2 text-sm text-gray-700 focus:bg-violet-200 focus:text-violet-900 focus:outline-hidden focus:font-semibold"
                                        popovertarget="po-{{ $report->id }}">
                                        {{ $report->isPaused() ? 'Reprendre' : 'Démarrer' }}
                                        <i class="bi bi-pencil-square ms-2"></i></button>
                                @endif
                                @if($report->isInProgress())
                                    <li>
                                        <a class="block px-4 py-2 text-sm text-gray-700 focus:bg-violet-200 focus:text-violet-900 focus:outline-hidden focus:font-semibold"
                                           href="{{ route('support.reports.edit', $report->identifier) }}">
                                            Editer
                                            <i class="bi bi-pencil-square ms-2"></i></a></li>
                                @endif
                                @if($report->isClosed())
                                    <a class="block px-4 py-2 text-sm text-gray-700 focus:bg-violet-200 focus:text-violet-900 focus:outline-hidden focus:font-semibold"
                                       href="{{ route('support.reports.download', $report->identifier) }}">
                                        Télécharger le rapport<i class="bi bi-download ms-2"></i></a>
                                @endif
                            </div>
                        </el-menu>
                    </el-dropdown>
                </div>
            </div>
        </div>
    </div>
</div>
