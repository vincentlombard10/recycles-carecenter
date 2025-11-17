@props(['items' => null, 'class' => ''])
<div class="{{ $class }}">
    {{ $items->onEachSide(1)->links() }}
</div>
