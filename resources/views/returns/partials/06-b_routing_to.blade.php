<div class="mb-3">
    <h4>Vers</h4>
    <table class="table table-sm">
        <tbody>
        <tr>
            <th style="width: 16rem;">Code</th>
            <td>{{ $productReturn->routing_to_code }}</td>
        </tr>
        <tr>
            <th>Nom</th>
            <td>{{ $productReturn->routing_to_name }}</td>
        </tr>
        <tr>
            <th>Adresse</th>
            <td>{{ $productReturn->routing_to_address1 }}</td>
        </tr>
        <tr>
            <th>Adresse</th>
            <td>{{ $productReturn->routing_to_address2 }}</td>
        </tr>
        <tr>
            <th>CP / Ville</th>
            <td>{{ $productReturn->routing_to_postcode }} {{ $productReturn->routing_to_city }}</td>
        </tr>
        </tbody>
    </table>
</div>
