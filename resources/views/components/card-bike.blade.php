<div class="Card_Item p-0 mb-2">
    <div class="title mb-1">Vélo concerné</div>
    <table class="table table-mini">
        <tbody>
        <tr>
            <th style="width: 6rem;">Code châssis</th>
            <td><span class="fw-semibold text-primary">{{ $item->serial_code }}</span></td>
        </tr>
        <tr>
            <th>Référence</th>
            <td><span class="fw-semibold">{{ $item->serial_itno }}</span></td>
        </tr>
        <tr>
            <th>Désignation</th>
            <td><span class="">{{ $item->serial_itds }}</span></td>
        </tr>
        <tr>
            <th>Marque</th>
            <td><span class="">{{ $item->serial_itcl }}</span></td>
        </tr>
        </tbody>
    </table>
</div>
