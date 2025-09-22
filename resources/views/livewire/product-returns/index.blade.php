<div>
    @if (count($items))
        @foreach($items as $item)
            <div>{{ $item->identifier }}</div>
        @endforeach

        <table class="table">
        <tbody>
            <tr>
                <td>
                    <table class="table m-0">
                        <tbody>
                        <tr>
                            @include('livewire.product-returns.partials.table.cell-identfier')
                            @include('livewire.product-returns.partials.table.cell-serial-component')
                            @include('livewire.product-returns.partials.table.cell-assignee-action-destination')
                            @include('livewire.product-returns.partials.table.cell-order-invoice-delivery')
                            @include('livewire.product-returns.partials.table.cell-status-actions')
                        </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
    @else
        <div>Il ne se passe pas grand chose ici.</div>
    @endif

</div>
