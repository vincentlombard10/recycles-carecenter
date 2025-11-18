<section class="row">
    <h2>Retours produit</h2>
    <div class="col-3 mb-3">
        <x-dashboard.counter
            title="tous"
            :count="$product_returns_count" />
    </div>
    <div class="col-3 mb-3">
        <x-dashboard.counter
            title="en attente"
            :count="$product_returns_pending_count" />
    </div>
    <div class="col-3 mb-3">
        <x-dashboard.counter
            title="reçus"
            :count="$product_returns_received_count" />
    </div>
    <div class="col-3 mb-3">
        <x-dashboard.counter
            title="Sandbox"
            :count="$product_returns_sandboxed_count" />
    </div>
</section>
