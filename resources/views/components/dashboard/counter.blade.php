@props([
    'count' => null,
    'title' => null,
    'percent' => false,
    'progress' => false,
    'total' => null,
    'class' => null,
    'suffix' => null
    ])
<div class="db-counter @if($class){{ $class }}@endif">
    @if($progress && $total)
    <div class="progressbar" style="width: {{ $count/$total * 100 }}%;">
    </div>
    @endif
    <div class="display">
        <div class="title">{{ $title }}</div>
        @if($count && $total > 0 && $percent)
        <div class="text-4xl font-extrabold">{{ round($count/$total, 0) * 100 }}@if($percent)%@endif</div>
        @elseif($count)
        <div class="text-4xl font-extrabold">{{ intval($count) }}{{ $suffix }}</div>
        @else
            <span class="text-4xl font-extrabold">-</span>
        @endif
    </div>
</div>
