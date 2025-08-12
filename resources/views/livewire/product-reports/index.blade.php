<div>
    <table class="table">
        <tbody>
        @foreach($reports as $report)
            <tr>
                @include('livewire.product-reports.partials.table.cell-identifier')
                @include('livewire.product-reports.partials.table.cell-comment')
                @include('livewire.product-reports.partials.table.cell-status-actions')
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
