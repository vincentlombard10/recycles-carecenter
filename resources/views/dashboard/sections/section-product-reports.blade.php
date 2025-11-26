<section class="row">
    <h2 class="mb-2 fw-bold">Expertises et rapports</h2>
    <div class="col-3 mb-4">
        <x-dashboard.counter
            title="en cours"
            class="Pink"
            :count="$product_reports_in_progress_count" />
    </div>
    <div class="col-3 mb-4">
        <x-dashboard.counter
            title="terminés"
            :count="$product_reports_closed_count" />
    </div>
    <div class="col-3 mb-4">
        <x-dashboard.counter
            title="traitement moyen"
            suffix=" min"
            :count="$product_reports_duration_time ?? null" />
    </div>
</section>
