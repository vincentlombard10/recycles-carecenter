<div class="mb-5">
    <h2>01. Qualification</h2>
    <table class="table table-sm">
        <tbody>
        <tr>
            <th style="width: 16rem;">Type de retour</th>
            <td>{{ $productReturn->type }}</td>
        </tr>
        <tr>
            <th>Contexte</th>
            <td>{{ $productReturn->context }}</td>
        </tr>
        <tr>
            <th>Motif</th>
            <td>{{ $productReturn->reason }}</td>
        </tr>
        <tr>
            <th>Assignation</th>
            <td>{{ $productReturn->assignation  }}</td>
        </tr>
        <tr>
            <th>Action</th>
            <td>{{ $productReturn->action  }}</td>
        </tr>
        <tr>
            <th>Destination</th>
            <td>{{ $productReturn->destination }}</td>
        </tr>
        </tbody>
    </table>
</div>
