<section>
    <h2 class="font-bold text-2xl mb-3">Contacts</h2>
    <div class="grid grid-cols-3 gap-x-6">
        <x-dashboard.counter
            title="tous"
            :count="$contacts_count" />
        <x-dashboard.counter
            title="doublons Zendesk"
            class="Sandbox"
            :count="$contacts_with_duplicates_count" />
    </div>
</section>
