<section class="row">
    <h2 class="mb-2 fw-bold">Numéros de série</h2>
    <div class="col-3 mb-4">
        <x-dashboard.counter
            title="tous"
            :count="$serials_count" />
    </div>
    <div class="col-3 mb-4">
        <x-dashboard.counter
            title="sans item associé"
            :count="$serials_without_item_count" />
    </div>
    <div class="col-3 mb-4">
        <x-dashboard.counter
            title="sans facture associé"
            :count="$serials_without_invoice_count" />
    </div>
</section>
