<div>
    <x-pagination :items="$contacts" class="mb-3"/>
    <div class="mb-3">
        @foreach ($contacts as $contact)
            <div class="bg bg-white p-3 lg:p-4 mb-2 rounded-md">
                <div class="grid grid-cols-[auto_8rem] gap-4">
                    <div class="grid md:grid-cols-[8rem_auto] gap-4">
                        <div class="column-left">
                            <h2 class="font-bold text-2xl mb-2">{{ $contact->code }}</h2>
                        </div>
                        <div class="column-right grid grid-cols-2 gap-4">
                            <div>
                                Column
                            </div>
                            <div>
                                Column
                            </div>
                        </div>
                    </div>
                    <div>
                        Div
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <x-pagination :items="$contacts" />
</div>
