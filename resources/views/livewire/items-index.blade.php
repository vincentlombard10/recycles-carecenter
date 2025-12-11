<div>
    <x-pagination :items="$items" class="mb-3"/>
    <table class="table-auto bg-white w-full mb-3">
        <thead class="bg-linear-to-r/oklch from-indigo-500 via-violet-500 to-purple-500 text-white py-2">
        <tr>
            <th class="w-[8rem] text-xs px-2 py-1">Code</th>
            <th class="text-left text-xs px-2 py-1">Désignation</th>
            <th class="w-[8rem] text-xs px-2 py-1">Marque</th>
            <th class="w-[8rem] text-xs px-2 py-1">Groupe</th>
        </tr>
        </thead>
        <tbody>
        @foreach($items as $item)
            <tr class="border-b-slate-300 border-b-1 hover:bg-orange-100">
                <td class="px-3 py-2">{{ $item->itno }}</td>
                <td class="px-3 py-2">{{ $item->itds }}</td>
                <td class="px-3 py-2 text-center">
                    @if($item->brand)
                        <span class="fw-semibold text-primary">{{ $item->brand->code }}</span>
                    @else
                        <span>{{ $item->brand_code }}</span>
                    @endif
                </td>
                <td class="px-3 py-2 text-center">
                    @if($item->group)
                        <span class="fw-semibold text-primary">{{ $item->group->code }}</span>
                    @else
                        <span>{{ $item->group_code }}</span>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <x-pagination :items="$items" />
</div>
