<div class="Card_Item p-0">
    <div class="title mb-1">Batterie concernée</div>
    @if($item->item)
        <table class="table table-mini">
            <tbody>
            <tr>
                <th style="width: 6rem;">Référence</th>
                <td><span class="fw-semibold">{{ $item->item->itno }}</span></td>
            </tr>
            <tr>
                <th>Désignation</th>
                <td><span class="">{{ $item->item->itds }}</span></td>
            </tr>
            </tbody>
        </table>
    @else
    <div>Référence : {{ $item->item_itno }}</div>
    <div>Référence : {{ $item->battery_type }}</div>
    @endif
</div>
