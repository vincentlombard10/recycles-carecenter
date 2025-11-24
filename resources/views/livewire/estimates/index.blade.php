<div>
    @if (isset($estimates) && count($estimates))
        @foreach($estimates as $item)
            <div>
                <ul>
                    <li><span class="fw-semibold">Identifiant :</span> {{ $item->report->identifier }}</li>
                    <li><span class="fw-semibold">Fichier :</span> {{ $item->file }}</li>
                    <li><span class="fw-semibold">State :</span> {{ $item->state }}</li>
                    <li><span class="fw-semibold">Workflow duration :</span> {{ $item->workflow_duration }}</li>
                    <li><span class="fw-semibold">Workflow duration within business hours :</span> {{ $item->workflow_duration_within_business_hours }}</li>
                    <li><span class="fw-semibold">Created at :</span> {{ $item->created_at }}</li>
                    <li><span class="fw-semibold">Updated at</span> {{ $item->updated_at }}</li>
                </ul>
            </div>
        @endforeach
    @else
        @lang('Data not available')
    @endif
</div>
