<div>
    <x-pagination :items="$groups" class="mb-3"/>
    <table class="table-auto bg-white w-full mb-3">
        <thead class="bg-violet-900 text-white py-2">
        <tr>
            <th style="width: 8rem;">Code</th>
            <th>Name</th>
        </tr>
        </thead>
        <tbody>
        @foreach($groups as $group)
            <tr class="border-b-slate-300 border-b-1 hover:bg-orange-100">
                <td class="px-3 py-2">{{ $group->code  }}</td>
                <td class="px-3 py-2">{{ $group->name  }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <x-pagination :items="$groups" />
</div>
