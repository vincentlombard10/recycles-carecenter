<section class="mb-4">
    <h2 class="font-bold text-2xl mb-3 dark:text-orange-500">Retours produit</h2>
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-6">
        <x-dashboard.counter
            title="tous"
            class="Violet"
            :count="$product_returns_count" />
        <x-dashboard.counter
            title="en attente"
            class="Pending"
            :count="$product_returns_pending_count" />
        <x-dashboard.counter
            title="reçus"
            class="Received"
            :count="$product_returns_received_count" />
        <x-dashboard.counter
            title="Sandbox"
            class="Sandbox"
            :count="$product_returns_sandboxed_count" />
    </div>
</section>
