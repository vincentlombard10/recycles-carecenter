<div>
    <div class="flex gap-4 mb-3 justify-between">
        <div class="flex-gap-2">
            <div>
                <label for="order" class="inline-block text-xs mb-1 font-semibold">Ordre d'affichage</label>
                <select name="order" wire:model.live="order" class="form-control min-w-[12rem]">
                    <option value="code_asc">Code A-Z / 0-9</option>
                    <option value="code_desc">Code Z-A / 9-0</option>
                    <option value="created_at_asc">Création la plus ancienne</option>
                    <option value="created_at_desc">Création la plus récente</option>
                    <option value="updated_at_asc">Modification la plus récente</option>
                    <option value="updated_at_desc">Modification la plus ancienne</option>
                </select>
            </div>
        </div>
        <x-pagination :items="$contacts" class="mb-3"/>

    </div>
    <div class="mb-3">
        @foreach ($contacts as $contact)
            <div class="bg bg-white p-3 lg:p-4 mb-2 rounded-md">
                <div class="grid grid-cols-[auto_8rem] gap-4">
                    <div class="grid md:grid-cols-[8rem_auto] gap-4">
                        <div class="column-left">
                            <h2 class="font-bold text-2xl mb-2">{{ $contact->code }}</h2>
                            <span class="badge-small">{{ $contact->mailjet_contact_id }}</span>
                        </div>
                        <div class="column-right grid grid-cols-[auto_16rem] gap-4">
                            <div>
                                <div>{{ $contact->address1 }}</div>
                                <div>{{ $contact->address2 }}</div>
                                <div>{{ $contact->postcode }} {{ $contact->city }} - {{ $contact->country }}</div>
                                <div>{{ $contact->phone }}</div>
                                <div>{{ $contact->email }}</div>
                            </div>
                            <div>
                                <div class="text-xs">Création : {{ date('d/m/Y H:i', strtotime($contact->created_at)) }}</div>
                                <div class="text-xs">Dernière modification : {{ date('d/m/Y H:i', strtotime($contact->updated_at)) }}</div>
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
