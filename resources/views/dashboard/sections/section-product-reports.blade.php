<section class="row">
    <h2>Expertises et rapports</h2>
    <div class="col-4 mb-3">
        <x-dashboard.counter
            title="en attente"
            :count="$product_reports_pending_count" />
    </div>
    <div class="col-4 mb-3">
        <x-dashboard.counter
            title="en cours"
            :count="$product_reports_in_progress_count" />
    </div>
</section>
