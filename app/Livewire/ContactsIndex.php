<?php

namespace App\Livewire;

use App\Models\Contact;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class ContactsIndex extends Component
{
    use WithPagination;
    public $searchTerm;

    public function render()
    {
        $contacts = Contact::where(function ($query) {
            return $query->whereAny(['code', 'name'], 'like', '%' . $this->searchTerm . '%');
        })->orderBy('code')->paginate(15);
        return view('livewire.contacts-index', compact('contacts'));
    }
    #[On('updatedSearchTerm')]
    public function updateSearchTerm($searchTerm)
    {
        $this->searchTerm = $searchTerm;
        $this->gotoPage(0);
        $this->resetPage();
    }

    public function updatedSearchTerm()
    {
        $this->gotoPage(0);
        $this->resetPage();
    }
}
