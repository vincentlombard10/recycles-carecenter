<div>
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
    {{ $groups->onEachSide(1)->links() }}
</div>
