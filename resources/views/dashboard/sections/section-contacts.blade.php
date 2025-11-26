<section class="row">
    <h2 class="mb-2 fw-bold">Contacts</h2>
    <div class="col-3 mb-4">
        <x-dashboard.counter
            title="tous"
            :count="$contacts_count" />
    </div>
    <div class="col-3 mb-4">
        <x-dashboard.counter
            title="doublons Zendesk"
            class="Sandbox"
            :count="$contacts_with_duplicates_count" />
    </div>
</section>
