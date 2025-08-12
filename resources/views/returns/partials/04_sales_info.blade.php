<div class="mb-5">
    <h2>04. Informations de vente</h2>
    <table class="table table-sm">
        <tbody>
        <tr>
            <th style="width: 16rem;">Date de vente</th>
            <td>{{ $productReturn->bike_sold_at }}</td>
        </tr>
        <tr>
            <th>Commande</th>
            <td>{{ $productReturn->order }}</td>
        </tr>
        <tr>
            <th>Facture</th>
            <td>{{ $productReturn->invoice }}</td>
        </tr>
        <tr>
            <th>Bon de livraison</th>
            <td>{{ $productReturn->delivery }}</td>
        </tr>
        </tbody>
    </table>
</div>
