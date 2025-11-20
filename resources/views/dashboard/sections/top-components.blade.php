<section class="row">
    <div class="col-lg-4 mb-3">
        <h2>Top Batteries</h2>
        <div class="card">
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    @foreach($top_batteries as $item)
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-1">
                            <div>
                                <div><span class="fw-semibold">{{ $item->item_itno }}</span></div>
                                <div><span>{{ $item->item_itds }}</span></div>
                            </div>
                        </li>
                    @endforeach
                    <span class="text-primary">{{ $item->total }}</span>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-lg-4 mb-3">
        <h2>Top Composants</h2>
        <div class="card">
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    @foreach($top_components as $item)
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-1">
                            <div>
                                <div><span class="fw-semibold">{{ $item->item_itno }}</span></div>
                                <div><span>{{ $item->item_itds }}</span></div>
                            </div>
                            <span class="text-primary">{{ $item->total }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    <div class="col-lg-4 mb-3">
        <h2>Top Vélos</h2>
        <div class="card">
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    @foreach($top_bikes as $item)
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-1">
                            <div>
                                <div><span class="fw-semibold">{{ $item->serial_itno }}</span></div>
                                <div><span>{{ $item->serial_itds }}</span></div>
                            </div>
                            <span class="text-primary">{{ $item->total }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</section>
