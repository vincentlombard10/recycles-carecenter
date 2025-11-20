<section class="row">
    <h2>Numéros de série</h2>
    <div class="col-3 mb-3">
        <x-dashboard.counter
            title="tous"
            :count="$serials_count" />
    </div>
    <div class="col-3 mb-3">
        <x-dashboard.counter
            title="sans item associé"
            :count="$serials_without_item_count" />
    </div>
</section>
