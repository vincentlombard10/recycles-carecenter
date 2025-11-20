<section class="row">
    <div class="col-lg-4 mb-3">
        <h2>Top Batteries</h2>
        <div class="card">
            <div class="card-body">
                @foreach($top_batteries as $item)
                    <div><span>{{ $item->item_itno }} | {{ $item->total }}</div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="col-lg-4 mb-3">
        <h2>Top Composants</h2>
        <div class="card">
            <div class="card-body">
                @foreach($top_batteries as $item)
                    <div><span>{{ $item->item_itno }} | {{ $item->total }}</div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="col-lg-4 mb-3">
        <h2>Top Vélos</h2>
        <div class="card">
            <div class="card-body">
                @foreach($top_bikes as $item)
                    <div><span>{{ $item->serial_itno }} | {{ $item->total }}</div>
                @endforeach
            </div>
        </div>
    </div>
</section>
