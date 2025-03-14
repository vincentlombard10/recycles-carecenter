<div>
    <table class="table">
        <thead>
        <tr>
            <th style="width: 8rem;">Code</th>
            <th>SKU Associé</th>
            <th style="width: 12rem;">Client</th>
            <th style="width: 12rem;">Commande</th>
            <th style="width: 12rem;">BL</th>
        </tr>
        </thead>
        <tbody>
        @foreach($serials as $serial)
            <tr>
                <td>{{ $serial->code  }}</td>
                <td>{{ $serial->item_itno  }}</td>
                <td>{{ $serial->customer_code  }}</td>
                <td>{{ $serial->order  }}</td>
                <td>{{ $serial->delivery  }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $serials->onEachSide(1)->links() }}
</div>
