<div>
    <x-pagination :items="$contacts" class="mb-3"/>
    <div class="mb-3">
        @foreach ($contacts as $contact)
            <div class="bg bg-white p-3 lg:p-4 mb-2 rounded-md">
                <div class="grid grid-cols-[auto_8rem] gap-4">
                    <div class="grid md:grid-cols-[8rem_auto] gap-4">
                        <div class="column-left">
                            <h2 class="font-bold text-2xl mb-2">{{ $contact->code }}</h2>
                            <span class="badge-small">{{ $contact->mailjet_contact_id }}</span>
                        </div>
                        <div class="column-right grid grid-cols-[auto_8rem] gap-4">
                            <div>
                                <div>{{ $contact->address1 }}</div>
                                <div>{{ $contact->address2 }}</div>
                                <div>{{ $contact->postcode }} {{ $contact->city }} - {{ $contact->country }}</div>
                                <div>{{ $contact->phone }}</div>
                                <div>{{ $contact->email }}</div>
                            </div>
                            <div>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col gap-1">
                        <div
                            class="badge s{{ $contact->status }} w-full mb-2">{{ $contact->status_label }}</div>
                        <div class="badge badge-small">{{ $contact->salesrep }}</div>

                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <x-pagination :items="$contacts" />
</div>
