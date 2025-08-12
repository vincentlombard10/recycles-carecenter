<div>
    @if (count($items))
    <table class="table">
        <tbody>
        @foreach($items as $item)
            <tr>
                <td>
                    <table class="table">
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
        @endforeach
        </tbody>
    </table>
    @else
        <div>Il ne se passe pas grand chose ici.</div>
    @endif

</div>
