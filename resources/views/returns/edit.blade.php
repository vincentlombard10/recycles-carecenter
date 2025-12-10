<x-app-layout>
    <x-page-header>
        <div class="flex px-4 justify-between items-center w-full">
            <div class="flex items-center gap-4">
                <a href="{{ route('support.returns.index') }}"
                   class="group flex px-1 h-10 bg-orange-500 rounded-full justify-center items-center hover:bg-orange-500"><span
                        class="bg-orage-600 flex justify-center items-center w-8 h-8 rounded-full text-white group-hover:bg-orange-700"><i
                            class="bi bi-cloud-download"></i></span>
                </a>
                <h1>Retour produit {{ $return->identifier }}</h1>
            </div>
        </div>
    </x-page-header>
    <x-page-wrapper>
        <x-messages/>
        <div class="max-w-[1200px]">
            {{ html()->form('PATCH', route('support.returns.update', $return))->open() }}
            <div id="product-return-form" data-return="{{ $return }}"></div>
            <div class="mb-3">
                {{ html()->submit('Mettre à jour')->class('bg-violet-800 font-bold text-white w-full px-4 py-4 rounded-lg hover:bg-violet-900 cursor-pointer') }}
            </div>
            {{ html()->form()->close() }}
            @if($return->trashed())
                <button class="dropdown-item text-end" popovertarget="po-restaure">Restaurer</button>
                <div id="po-restaure" popover class="popover text-center">
                    <h5 class="font-bold text-xl mb-3">Souhaitez-vous restaurer le retour {{ $return->identifier }} ?</h5>
                    {{ html()->form('post', route('support.returns.restore', $return->identifier))->open() }}
                    <div class="d-grid mb-2"><input type="submit" class="bg-blue-500 px-6 py-4 font-bold text-xl rounded-lg w-full text-white" value="Oui" name="do"/></div>
                    {{ html()->form()->close() }}
                    <div class="d-grid">
                        <button popovertarget="po-restaure" popovertargetaction="hide" class="btn btn-sm">Annuler</button>
                    </div>
                </div>
                <button class="dropdown-item text-end" popovertarget="po-force-delete">Supprimer</button>

                <div id="po-force-delete" popover class="popover text-center">
                    <h5 class="font-bold text-xl mb-3">Souhaitez-vous supprimer définitivement le retour {{ $return->identifier }} ?</h5>
                    <p>Attention, une fois supprimé, ce retour ne pourra plus être récupéré.</p>
                    {{ html()->form('delete', route('support.returns.forceDelete', $return))->open() }}
                    <div class="d-grid mb-2"><input type="submit" class="bg-blue-500 px-6 py-4 font-bold text-xl rounded-lg w-full text-white" value="Oui" name="do"/></div>
                    {{ html()->form()->close() }}
                    <div class="d-grid">
                        <button popovertarget="po-delete" popovertargetaction="hide" class="btn btn-sm">Annuler</button>
                    </div>
                </div>
            @else
                <button class="dropdown-item text-end" popovertarget="po-archive">Archiver</button>
                <div id="po-archive" class="popover text-center" popover>
                    <h5 class="font-bold text-xl mb-3">Souhaitez-vous archiver le retour {{ $return->identifier }} ?</h5>
                    {{ html()->form('delete', route('support.returns.destroy', $return))->open() }}
                    <div class="d-grid mb-2"><input type="submit" class="bg-blue-500 px-6 py-4 font-bold text-xl rounded-lg w-full text-white" value="Oui" name="do"/></div>
                    {{ html()->form()->close() }}
                    <div class="d-grid">
                        <button popovertarget="po-archive" popovertargetaction="hide" class="btn btn-sm">Annuler</button>
                    </div>
                </div>
            @endif
        </div>
    </x-page-wrapper>
</x-app-layout>
