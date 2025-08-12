<div class="mb-5">
    <h2>03. Produit associé</h2>
    @if($productReturn->serial)
        <table class="table table-sm">
            <tbody>
            <tr>
                <th style="width: 16rem;">Numéro de série</th>
                <td>{{ $productReturn->serial->code }}</td>
            </tr>
            <tr>
                <th>Marque</th>
                <td>{{ $productReturn->serial->item->brand->name ?? $productReturn->serial->item->brand->code }}</td>
            </tr>
            <tr>
                <th>SKU</th>
                <td>{{ $productReturn->serial->item_itno }}</td>
            </tr>
            <tr>
                <th>Désignation</th>
                <td>{{ $productReturn->serial->item->itds }}</td>
            </tr>
            </tbody>
        </table>
    @elseif($productReturn->item)
        <table class="table table-sm">
            <tbody>
            <tr>
                <th style="width: 16rem;">Référence</th>
                <td>{{ $productReturn->item?->itno }}</td>
            </tr>
            <tr>
                <th>Désignation</th>
                <td>{{ $productReturn->item?->itds }}</td>
            </tr>
            </tbody>
        </table>
    @else
        Nope
    @endif
</div>
