<section class="mb-4">
    <h2 class="font-bold text-2xl mb-3">Top retours</h2>
    <div class="grid grid-cols-3 gap-x-6">
        <div class="mb-4">
            <h2 class="font-bold">Top batteries</h2>
            <div class="bg-white p-4 rounded-lg">
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        @forelse($top_batteries as $item)
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-1">
                                <div>
                                    <div><span class="fw-bold text-violet-900">{{ $item->item_itno }}</span></div>
                                    <div><span class="text-xs">{{ $item->item_itds }}</span></div>
                                </div>
                                <span class="text-primary">{{ $item->total }}</span>
                            </li>
                        @empty
                            @lang('Data not available...')
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
        <div class="mb-4">
            <h2 class="font-bold">Top Vélos</h2>
            <div class="bg-white p-4 rounded-lg">
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        @forelse($top_components as $item)
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-1">
                                <div>
                                    <div><span class="fw-bold text-violet-900">{{ $item->item_itno }}</span></div>
                                    <div><span class="text-xs">{{ $item->item_itds }}</span></div>
                                </div>
                                <span class="text-primary">{{ $item->total }}</span>
                            </li>
                        @empty
                            @lang('Data not available...')
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
        <div class="mb-4">
            <h2 class="font-bold">Top Vélos</h2>
            <div class="bg-white p-4 rounded-lg">
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        @forelse($top_bikes as $item)
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-1">
                                <div>
                                    <div><span class="fw-bold text-violet-900">{{ $item->serial_itno }}</span></div>
                                    <div><span class="text-xs">{{ $item->serial_itds }}</span></div>
                                </div>
                                <span class="text-primary">{{ $item->total }}</span>
                            </li>
                        @empty
                            @lang('Data not available...')
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
