<div class="mx-auto max-w-[1200px]">
    <x-pagination :items="$brands" class="mb-3"/>
    <table class="table-auto bg-white w-full mb-3">
        <thead class="bg-linear-to-r/oklch from-indigo-500 via-violet-500 to-purple-500 text-white py-2">
        <tr>
            <th class="w-[8rem] text-xs py-1">Code</th>
            <th class="text-left text-xs py-1">Name</th>
        </tr>
        </thead>
        <tbody>
        @foreach($brands as $brand)
            <tr class="border-b-slate-300 border-b-1 hover:bg-orange-100">
                <td class="px-3 py-2">{{ $brand->code  }}</td>
                <td class="px-3 py-2">{{ $brand->name ?? $brand->code  }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <x-pagination :items="$brands" />
</div>
