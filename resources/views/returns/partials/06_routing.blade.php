<div class="mb-5">
    <h2>06. Routing</h2>
    @include('returns.partials.06-a_routing_from')
    @include('returns.partials.06-b_routing_to')
    @if ($productReturn->return_code)
    @include('returns.partials.06-c_return')
    @endif
</div>
