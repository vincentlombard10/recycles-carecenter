<div>
    <div class="text-lg font-bold mb-1">Batterie concernée</div>
    @if($item->item)
        <table class="table-auto w-full">
            <tbody>
            <tr>
                <th class="text-left w-[8rem]">Référence</th>
                <td><span class="fw-semibold">{{ $item->item->itno }}</span></td>
            </tr>
            <tr>
                <th class="text-left w-[8rem]">Désignation</th>
                <td class="border-spacing-72"><span class="">{{ $item->item->itds }}</span></td>
            </tr>
            </tbody>
        </table>
    @else
    <div>Référence : {{ $item->item_itno }}</div>
    <div>Référence : {{ $item->battery_type }}</div>
    @endif
</div>
