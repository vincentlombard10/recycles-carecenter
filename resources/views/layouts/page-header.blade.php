<div class="bg-white h-16 fixed top-0 w-[calc(100vw-4rem)] z-10 shadow-sm px-4">
    <div class="flex max-w-[1200px] mx-auto gap-4 h-16 items-center justify-between">
        {{ $slot }}
        <div class="border-l-1 border-l-slate-200">
            {{ html()->form('POST', route('logout'))->open() }}
            <button class="w-10 h-10 flex justify-center items-center bg-slate-200 rounded-full text-white hover:bg-rose-600">
                <i class="bi bi-power"></i><span
                    class="sidebar-link__label"></span></button>
            {{ html()->form()->close() }}
        </div>
    </div>
</div>
