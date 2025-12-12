<div>
    <table class="table-auto bg-white w-full mb-3">
        <thead class="bg-violet-900 text-white py-2">
        <tr>
            <th class="py-1 text-xs text-left px-3">Rôle</th>
            <th class="w-[10rem] py-1 text-xs px-3">&nbsp;</th>
        </tr>
        </thead>
        @foreach($roles as $role)
            <tr class="border-b-slate-300 border-b-1 hover:bg-orange-100 dark:bg-zinc-900 dark:border-b-zinc-700 dark:hover:bg-violet-950 dark:hover:text-white">
                <td class="px-3 py-2">{{ $role->public_name }}</td>
                <td class="px-3 py-2">
                    <el-dropdown>
                        <button
                            role="button"
                            popovertarget="item-{{ $role->id }}"
                            class="inline-flex bg-violet-100 justify-center rounded-md w-full text-sm font-semibold text-gray-900 hover:bg-gray-50 py-2">
                            Actions
                            <svg viewBox="0 0 20 20" fill="currentColor" data-slot="icon" aria-hidden="true"
                                 class="-mr-1 size-5 text-gray-400">
                                <path
                                    d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z"
                                    clip-rule="evenodd" fill-rule="evenodd"/>
                            </svg>
                        </button>

                        <el-menu anchor="bottom end" id="role-{{ $role->identifier }}" popover
                                 class="w-32 origin-top-right rounded-md bg-white shadow-lg outline-1 outline-black/5 transition transition-discrete [--anchor-gap:--spacing(2)] data-closed:scale-95 data-closed:transform data-closed:opacity-0 data-enter:duration-100 data-enter:ease-out data-leave:duration-75 data-leave:ease-in">
                            <div class="py-0">
                                    <a class="block px-4 py-2 text-sm text-gray-700 focus:bg-violet-200 focus:text-violet-900 focus:outline-hidden focus:font-semibold"
                                       href="{{ route('admin.roles.edit', $role) }}">
                                        Editer</a>
                            </div>
                        </el-menu>
                    </el-dropdown>
                </td>

            </tr>
        @endforeach
        </tbody>
    </table>
</div>
