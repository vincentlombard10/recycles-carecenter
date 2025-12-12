<div class="bg-white h-16 fixed top-0 w-[calc(100vw-4rem)] z-10 shadow-sm px-4 dark:bg-linear-to-r/oklch dark:from-indigo-500 dark:via-violet-500 dark:to-violet-500 text-white">
    <div class="flex max-w-[1200px] mx-auto gap-4 h-16 items-center justify-between">
        {{ $slot }}
        <div>
            {{ html()->form('POST', route('logout'))->open() }}
            <button class="group w-10 h-10 flex justify-center items-center bg-slate-200 rounded-full text-white hover:bg-rose-600">
                <x-heroicon-o-power class="w-4 h-4 text-rose-800 group-hover:text-white" /></button>
            {{ html()->form()->close() }}
        </div>
    </div>
</div>
