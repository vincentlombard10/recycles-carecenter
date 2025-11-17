<div>
    <x-pagination :items="$brands" class="mb-3"/>
    <table class="table">
        <thead>
        <tr>
            <th style="width: 8rem;">Code</th>
            <th>Name</th>
        </tr>
        </thead>
        <tbody>
        @foreach($brands as $brand)
            <tr>
                <td>{{ $brand->code  }}</td>
                <td>{{ $brand->name  }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <x-pagination :items="$brands" />
</div>
