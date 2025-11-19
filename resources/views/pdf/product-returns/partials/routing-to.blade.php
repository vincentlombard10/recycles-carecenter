<div>{{ strtoupper($productReturn->routing_to_name ?? $productReturn->recipient->name) }}</div>
<div>{{ strtoupper($productReturn->routing_to_address1) }}</div>
<div>{{ strtoupper($productReturn->routing_to_address2) }}</div>
<div>{{ $productReturn->routing_to_postcode }} {{ strtoupper($productReturn->routing_to_city) }}</div>
<div>Tél : {{ $productReturn->routing_to_phone }}</div>
