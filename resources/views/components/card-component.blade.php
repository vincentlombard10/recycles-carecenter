<div class="Card_Item p-0 mb-2">
    <div class="title mb-1">Composant concerné</div>
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
        <tr>
            <th>QUantité</th>
            <td><span class="">{{ $item->item_quantity }}</span></td>
        </tr>
        </tbody>
    </table>
</div>
