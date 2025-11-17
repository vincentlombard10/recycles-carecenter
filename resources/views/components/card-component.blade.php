<div class="Card_Item p-0 mb-2">
    <div class="title mb-1">Composant concerné</div>
    @if($item->item)
        <table class="table table-mini">
            <tbody>
            <tr>
                <th style="width: 6rem;">Référence</th>
                <td><span class="fw-semibold">{{ $item->item_itno }}</span></td>
            </tr>
            <tr>
                <th>Désignation</th>
                <td><span class="">{{ $item->item_itds }}</span></td>
            </tr>
            </tbody>
        </table>
    @else
        <div>Référence : {{ $item->item_itno }}</div>
    @endif
</div>
