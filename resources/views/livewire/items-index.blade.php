<div>
    <table class="table">
        <thead>
        <tr>
            <th style="width: 12rem;">Code</th>
            <th>Désignation</th>
            <th style="width: 6rem;">Marque</th>
            <th style="width: 6rem;">Groupe</th>
            <th style="width: 6rem;">Statut</th>
        </tr>
        </thead>
        <tbody>
        @foreach($items as $item)
            <tr>
                <td>{{ $item->itno }}</td>
                <td>{{ $item->itds }}</td>
                <td>{{ $item->brand_code }}</td>
                <td>{{ $item->group_code }}</td>
                <td>{{ $item->status }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $items->onEachSide(1)->links() }}
</div>
