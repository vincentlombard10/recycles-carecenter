<div class="mx-auto max-w-[1200px]">
    @if (isset($estimates) && count($estimates))
        @forelse($estimates as $item)
            <div class="bg bg-white p-3 lg:p-4 mb-2 rounded-md">
                <div class="grid grid-cols-[auto_8rem] gap-4">
                    <div class="grid md:grid-cols-[8rem_auto] gap-4">
                        <div class="column-left">
                            <h2 class="font-bold text-2xl mb-2">{{ $item->report->identifier }}</h2>
                        </div>
                        <div class="column-right grid grid-cols-[auto_8rem] gap-4">
                            <div>
                                <ul>
                                    <li><span class="fw-semibold">Fichier :</span> {{ $item->file }}</li>
                                    <li><span class="fw-semibold">State :</span> {{ $item->state }}</li>
                                    <li><span class="fw-semibold">Workflow duration :</span> {{ $item->workflow_duration }}</li>
                                    <li><span class="fw-semibold">Workflow duration within business hours :</span> {{ $item->workflow_duration_within_business_hours }}</li>
                                    <li><span class="fw-semibold">Created at :</span> {{ $item->created_at }}</li>
                                    <li><span class="fw-semibold">Updated at</span> {{ $item->updated_at }}</li>
                                </ul>
                            </div>
                            <div>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col gap-1">
                    </div>
                </div>
            </div>
        @empty
            <div class="flex justify-between px-4 py-3 rounded bg-linear-to-r/oklch from-indigo-500 via-violet-500 to-purple-500 text-white text-xs">
                <div>Aucun résultat pour cette sélection.</div>
            </div>
        @endforelse
    @else
        <div class="flex justify-between px-4 py-3 rounded bg-linear-to-r/oklch from-indigo-500 via-violet-500 to-purple-500 text-white text-xs">
            <div>Aucun devis.</div>
        </div>
    @endif
</div>
