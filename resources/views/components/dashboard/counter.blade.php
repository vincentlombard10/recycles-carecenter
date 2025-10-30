@props([
    'count' => null,
    'title' => null,
    'percent' => false,
    'progress' => false,
    'total' => null,
    ])
<div class="db-counter">
    @if($progress && $total)
    <div class="progressbar" style="width: {{ $count/$total * 100 }}%;">
    </div>
    @endif
    <div class="display">
        <div class="title">{{ $title }}</div>
        @if($count && $total > 0 && $percent)
        <div class="count">{{ round($count/$total, 2) * 100 }}@if($percent)%@endif</div>
        @else
        <div class="count">{{ $count }}</div>
        @endif
    </div>
</div>
