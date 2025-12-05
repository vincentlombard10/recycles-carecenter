<?php

namespace App\Livewire;

use App\Models\Serial;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;

class SerialsIndex extends Component
{
    use WithPagination;

    public $searchTerm;

    public bool $orphans = false;

    public function render()
    {
        $serials = Serial::where(function ($query) {
            $query->whereAny(['code', 'item_itno', 'dealer_code', 'last_order', 'last_delivery'], 'like', '%' . $this->searchTerm . '%');
            $query->when($this->orphans, function ($query) {
                $query->doesnthave('item');
            });
        })->orderBy('out', 'desc')->paginate(15);

        return view('livewire.serials-index', compact('serials'));
    }

    #[On('updatedSearchTerm')]
    public function updateSerialsList($searchTerm = '')
    {
        $this->searchTerm = $searchTerm;
        $this->goToPage(1);
    }
}
