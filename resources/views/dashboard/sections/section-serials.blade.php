<section class="mb-4">
    <h2 class="font-bold text-2xl mb-3 dark:text-zinc-600">Numéros de série</h2>
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-6">
        <x-dashboard.counter
            title="tous"
            :count="$serials_count" />
        <x-dashboard.counter
            title="sans item associé"
            :count="$serials_without_item_count" />
        <x-dashboard.counter
            title="sans facture associé"
            :count="$serials_without_invoice_count" />
    </div>
</section>
