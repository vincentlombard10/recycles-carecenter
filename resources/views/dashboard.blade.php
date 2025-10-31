<x-app-layout>
    <x-messages />
    <x-page-wrapper>
        <div class="container-fluid">
            <div class="row">
                <h2>Codes chassis</h2>
                <div class="col-4 mb-3">
                    <x-dashboard.counter
                        title="Tous"
                        :count="$serials_count" class="mb-3"/>
                </div>
                <div class="col-4 mb-3">
                    @if($serials_count > 0)
                    <x-dashboard.counter
                        title="sans facture associée"
                        :percent="true"
                        :progress="true"
                        :total="$serials_count"
                        :count="$serial_without_invoice_count" />
                    @endif
                </div>
                <div class="col-4 mb-3">
                    <x-dashboard.counter
                        title="sans article associé"
                        :total="$serials_count"
                        :progress="true"
                        :count="$serials_without_item" />
                </div>
            </div>
            <div class="row">
                <h2>Tickets</h2>
                <div class="col-4 mb-3">
                    <div class="mb-2">
                        <x-dashboard.counter
                            title="Nouveau"
                            class="db-counter--zd New"
                            :count="$tickets_new_count" />
                    </div>
                </div>
                <div class="col-4 mb-3">
                    <x-dashboard.counter
                        title="Ouvert"
                        class="db-counter--zd Open"
                        :count="$tickets_open_count" />
                </div>
                <div class="col-4 mb-3">
                    <x-dashboard.counter
                        title="En attente"
                        class="db-counter--zd Hold"
                        :count="$tickets_hold_or_pending_count" />
                </div>
            </div>
            <div class="row">
                <h2>Retours produit</h2>
                <div class="col-4 mb-3">
                    <x-dashboard.counter
                        title="en attente"
                        :count="$product_returns_pending_count" />
                </div>
            </div>
            <div class="row">
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
            </div>
        </div>
    </x-page-wrapper>
</x-app-layout>
