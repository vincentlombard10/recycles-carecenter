<div>
    <table class="table">
        <thead>
        <tr>
            <th style="width: 12rem;">Code</th>
            <th>Désignation</th>
            <th style="width: 6rem;">Marque</th>
            <th style="width: 6rem;">Groupe</th>
        </tr>
        </thead>
        <tbody>
        @foreach($items as $item)
            <tr>
                <td>{{ $item->itno }}</td>
                <td>{{ $item->itds }}</td>
                <td>
                    @if($item->brand)
                        <span class="fw-semibold text-primary">{{ $item->brand->code }}</span>
                    @else
                        <span>{{ $item->brand_code }}</span>
                    @endif
                </td>
                <td>
                    @if($item->group)
                        <span class="fw-semibold text-primary">{{ $item->group->code }}</span>
                    @else
                        <span>{{ $item->group_code }}</span>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $items->onEachSide(1)->links() }}
</div>
