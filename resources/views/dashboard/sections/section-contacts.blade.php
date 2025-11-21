<section class="row">
    <h2>Contacts</h2>
    <div class="col-3 mb-3">
        <x-dashboard.counter
            title="tous"
            :count="$contacts_count" />
    </div>
    <div class="col-3 mb-3">
        <x-dashboard.counter
            title="doublons Zendesk"
            class="Sandbox"
            :count="$contacts_with_duplicates_count" />
    </div>
</section>
