<div>
    <div class="text-lg font-bold mb-1">Vélo concerné</div>
    <table class="table table-auto w-full">
        <tbody>
        <tr>
            <th class="text-left w-[8rem]">Code châssis</th>
            <td><span class="fw-semibold text-primary">{{ $item->serial_code }}</span></td>
        </tr>
        <tr>
            <th class="text-left w-[8rem]">Référence</th>
            <td><span class="fw-semibold">{{ $item->serial_itno }}</span></td>
        </tr>
        <tr>
            <th class="text-left w-[8rem]">Désignation</th>
            <td><span class="">{{ $item->serial_itds }}</span></td>
        </tr>
        <tr>
            <th class="text-left w-[8rem]">Marque</th>
            <td><span class="">{{ $item->serial_itcl }}</span></td>
        </tr>
        </tbody>
    </table>
</div>
