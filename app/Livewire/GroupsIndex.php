<?php

namespace App\Livewire;

use App\Models\Group;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;
class GroupsIndex extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    private $searchTerm;

    public function render()
    {
        $groups = Group::where(function ($query) {
            $query->whereAny(['code', 'name'], 'like', '%' . $this->searchTerm . '%');
        })->paginate(15);

        return view('livewire.groups-index', compact('groups'));
    }

    #[On('updatedSearchTerm')]
    public function updateSearchTerm($searchTerm)
    {
        $this->searchTerm = $searchTerm;
    }
}
