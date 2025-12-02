<div>
    <div class="text-lg font-bold mb-1">Composant concerné</div>
    <table class="table-auto w-full">
        <tbody>
        <tr>
            <th class="text-left w-[8rem]">Référence</th>
            <td class="border-spacing-72"><span class="font-semibold">{{ $item->item_itno }}</span></td>
        </tr>
        <tr>
            <th class="text-left w-[8rem]">Désignation</th>
            <td><span class="">{{ $item->item_itds }}</span></td>
        </tr>
        <tr>
            <th class="text-left w-[8rem]">Quantité</th>
            <td><span class="">{{ $item->item_quantity ?? "/!\\" }}</span></td>
        </tr>
        </tbody>
    </table>
</div>
