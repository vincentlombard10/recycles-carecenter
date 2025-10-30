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
        <div class="count">{{ $count }} @if($percent)&nbsp;%@endif</div>
    </div>
</div>
