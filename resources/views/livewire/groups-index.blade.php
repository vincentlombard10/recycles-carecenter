<div>
    <x-pagination :items="$groups" class="mb-3"/>
    <table class="table">
        <thead>
        <tr>
            <th style="width: 8rem;">Code</th>
            <th>Name</th>
        </tr>
        </thead>
        <tbody>
        @foreach($groups as $group)
            <tr>
                <td>{{ $group->code  }}</td>
                <td>{{ $group->name  }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <x-pagination :items="$groups" />
</div>
