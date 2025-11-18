<section class="row">
    <h2>Retours produit</h2>
    <div class="col-3 mb-3">
        <x-dashboard.counter
            title="tous"
            class="Violet"
            :count="$product_returns_count" />
    </div>
    <div class="col-3 mb-3">
        <x-dashboard.counter
            title="en attente"
            class="Pending"
            :count="$product_returns_pending_count" />
    </div>
    <div class="col-3 mb-3">
        <x-dashboard.counter
            title="reçus"
            class="Received"
            :count="$product_returns_received_count" />
    </div>
    <div class="col-3 mb-3">
        <x-dashboard.counter
            title="Sandbox"
            class="Sandbox"
            :count="$product_returns_sandboxed_count" />
    </div>
</section>
