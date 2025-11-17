<div>
    @if(count($reports))
        <x-pagination :items="$reports" class="mb-3"/>
        <div class="mb-3">
            @foreach($reports as $report)
                <x-support.card-report :report="$report"/>
                <x-support.card-report-popver :report="$report" />
            @endforeach
        </div>
        <x-pagination :items="$reports" />
    @endif
</div>
