<div class="mb-3">
    <h4>Depuis</h4>
    <table class="table table-sm">
        <tbody>
        <tr>
            <th style="width: 16rem;">Code</th>
            <td>{{ $productReturn->routing_from_code }}</td>
        </tr>
        <tr>
            <th>Nom</th>
            <td>{{ $productReturn->routing_from_name }}</td>
        </tr>
        <tr>
            <th>Adresse</th>
            <td>{{ $productReturn->routing_from_address1 }}</td>
        </tr>
        <tr>
            <th>Adresse</th>
            <td>{{ $productReturn->routing_from_address2 }}</td>
        </tr>
        <tr>
            <th>CP / Ville</th>
            <td>{{ $productReturn->routing_from_postcode }} {{ $productReturn->routing_from_city }}</td>
        </tr>
        </tbody>
    </table>
</div>
