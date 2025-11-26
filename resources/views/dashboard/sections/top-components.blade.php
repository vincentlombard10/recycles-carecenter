<section class="row">
    <div class="col-lg-4 mb-4">
        <h2 class="mb-2 fw-bold">Top Batteries</h2>
        <div class="card">
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
    <div class="col-lg-4 mb-4">
        <h2 class="mb-2 fw-bold">Top Composants</h2>
        <div class="card">
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
    <div class="col-lg-4 mb-4">
        <h2 class="mb-2 fw-bold">Top Vélos</h2>
        <div class="card">
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
</section>
