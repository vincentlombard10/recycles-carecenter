<section class="mb-4">
    <h2 class="font-bold text-2xl mb-3 dark:text-zinc-600">Top retours</h2>
    <div class="grid grid-cols-3 gap-x-6">
        <div class="mb-4">
            <h2 class="font-bold mb-3 dark:text-violet-400">Top batteries</h2>
            @if($top_batteries->count())
                <ul class="bg-white rounded-lg px-4 py-3 dark:bg-zinc-800">
                    @foreach($top_batteries as $item)
                        <li class="flex justify-between not-last:mb-2">
                            <div>
                                <div><span class="font-bold text-violet-900 dark:text-violet-500">{{ $item->item_itno }}</span></div>
                                <div><span class="text-xs">{{ $item->item_itds }}</span></div>
                            </div>
                            <span class="font-bold text-2xl text-violet-900 dark:text-violet-500">{{ $item->total }}</span>
                        </li>
                    @endforeach
                </ul>
            @else
                <span
                    class="px-3 py-2 bg-violet-50 inline-block w-full rounded-lg text-violet-800 font-semibold">@lang('Data not available...')</span>
            @endif
        </div>
        <div class="mb-4">
            <h2 class="font-bold mb-3 dark:text-violet-400">Top Vélos</h2>
            @if($top_components->count())
                <ul class="bg-white rounded-lg px-4 py-3 dark:bg-zinc-800">
                    @foreach($top_components as $item)
                        <li class="flex justify-between not-last:mb-2">
                            <div>
                                <div><span class="font-bold text-violet-900 dark:text-violet-500">{{ $item->item_itno }}</span></div>
                                <div><span class="text-xs">{{ $item->item_itds }}</span></div>
                            </div>
                            <span class="font-bold text-2xl text-violet-900 dark:text-violet-500">{{ $item->total }}</span>
                        </li>
                    @endforeach
                </ul>
            @else
                <span
                    class="px-3 py-2 bg-violet-50 inline-block w-full rounded-lg text-violet-800 font-semibold">@lang('Data not available...')</span>
            @endif
        </div>
        <div class="mb-4">
            <h2 class="font-bold mb-3 dark:text-violet-400">Top Vélos</h2>
            @if($top_bikes->count())
                <ul class="bg-white rounded-lg px-4 py-3 dark:bg-zinc-800">
                    @foreach($top_bikes as $item)
                        <li class="flex justify-between not-last:mb-2">
                            <div>
                                <div><span class="font-bold text-violet-900 dark:text-violet-500">{{ $item->serial_itno }}</span></div>
                                <div><span class="text-xs">{{ $item->serial_itds }}</span></div>
                            </div>
                            <span class="font-bold text-2xl text-violet-900 dark:text-violet-500">{{ $item->total }}</span>
                        </li>
                    @endforeach
                </ul>
            @else
                <span
                    class="px-3 py-2 bg-violet-50 inline-block w-full rounded-lg text-violet-800 font-semibold">@lang('Data not available...')</span>
            @endif
        </div>
    </div>
</section>
