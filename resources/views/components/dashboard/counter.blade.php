@props([
    'count' => null,
    'title' => null,
    'percent' => false,
    ])
<div class="db-counter">
    <div class="title">{{ $title }}</div>
    <div class="count">{{ $count }} @if($percent)&nbsp;%@endif</div>
</div>
