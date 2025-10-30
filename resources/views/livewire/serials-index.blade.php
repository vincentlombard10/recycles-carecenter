<div>
    <table class="table">
        <thead>
        <tr>
            <th style="width: 6rem;">Code</th>
            <th>SKU</th>
            <th>Designation</th>
            <th style="width: 6rem;">Client</th>
            <th style="width: 6rem;">Commande</th>
            <th style="width: 6rem;">BL</th>
            <th style="width: 6rem;">Out</th>
            <th style="width: 12rem;">Facture</th>
        </tr>
        </thead>
        <tbody>
        @foreach($serials as $serial)
            <tr>
                <td>{{ $serial->code  }}</td>
                <td>
                    @if($serial->item)
                        <span class="fw-semibold text-primary">{{ $serial->item->itno }}</span>
                    @else
                        <span>{{ $serial->item_itno  }}</span>
                    @endif
                </td>
                <td>
                    @if($serial->item)
                        <span class="">{{ $serial->item->itds }}</span>
                    @endif
                </td>
                <td>{{ $serial->dealer_code  }}</td>
                <td>{{ $serial->last_order  }}</td>
                <td>{{ $serial->last_delivery  }}</td>
                <td>{{ date('d/m/Y', $serial->out) }}</td>
                <td>{{ $serial->last_invoice  }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $serials->onEachSide(1)->links() }}
</div>
