<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UsersIndex extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public string $searchTerm = '';
    public function render()
    {
        $users = User::where(function ($query) {
            $query->whereAny(['name', 'email'], 'like', '%' . $this->searchTerm . '%');
        })->orderBy('name')->paginate(10);
        return view('livewire.users-index', compact('users'));
    }

    public function updatedSearchTerm($searchTerm = '')
    {
        $this->searchTerm = $searchTerm;
        $this->goToPage(1);
    }
}
