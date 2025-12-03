<div class="page-header h-16 flex">
    {{ $slot }}
    <div class="px-3 border-l-1 border-l-slate-200">
        {{ html()->form('POST', route('logout'))->open() }}
        <button class="w-10 h-10 flex justify-center items-center bg-slate-500 rounded-full text-white hover:bg-rose-600">
            <i class="bi bi-power"></i><span
                class="sidebar-link__label"></span></button>
        {{ html()->form()->close() }}
    </div>
</div>
