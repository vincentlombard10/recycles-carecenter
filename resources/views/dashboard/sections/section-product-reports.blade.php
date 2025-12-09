<section class="mb-4">
    <h2 class="font-bold text-2xl mb-3">Expertises et rapports d'intervention</h2>
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-x-6">
        <x-dashboard.counter
            title="en attente"
            class="bg-orange-300"
            :count="$product_reports_pending_count" />
        <x-dashboard.counter
            title="en cours"
            class="Pink"
            :count="$product_reports_in_progress_count" />
        <x-dashboard.counter
            title="terminés"
            :count="$product_reports_closed_count" />
        <x-dashboard.counter
            title="traitement moyen"
            suffix=" min"
            :count="$product_reports_duration_time ?? null" />
    </div>
</section>
