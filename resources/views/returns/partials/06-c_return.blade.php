<div class="mb-3">
    <h4>Retour</h4>
    <table class="table table-sm">
        <tbody>
        <tr>
            <th style="width: 16rem;">Code</th>
            <td>{{ $productReturn->return_code }}</td>
        </tr>
        <tr>
            <th>Nom</th>
            <td>{{ $productReturn->return_name }}</td>
        </tr>
        <tr>
            <th>Adresse</th>
            <td>{{ $productReturn->return_address1 }}</td>
        </tr>
        <tr>
            <th>Adresse</th>
            <td>{{ $productReturn->return_address2 }}</td>
        </tr>
        <tr>
            <th>CP / Ville</th>
            <td>{{ $productReturn->return_postcode }} {{ $productReturn->return_city }}</td>
        </tr>
        </tbody>
    </table>
</div>
