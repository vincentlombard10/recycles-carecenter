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
    public string $order = 'updated_at_desc';

    public function render()
    {
        $contacts = Contact::where(function ($query) {
            return $query->whereAny(['code', 'name'], 'like', '%' . $this->searchTerm . '%');
        })
            ->when($this->order, function ($query) {
                if ($this->order === 'updated_at_desc') {
                    return $query->orderBy('updated_at', 'desc');
                } else if ($this->order === 'created_at_desc') {
                    return $query->orderBy('created_at', 'desc');
                } else if ($this->order === 'updated_at_asc') {
                    return $query->orderBy('updated_at');
                } else if ($this->order === 'created_at_asc') {
                    return $query->orderBy('created_at');
                } else if ($this->order === 'code_asc') {
                    return $query->orderBy('code');
                } else if ($this->order === 'code_desc') {
                    return $query->orderBy('code' , 'desc');
                }
            })
            ->orderBy('code')->paginate(15);
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

    public function updatedOrder(string $order)
    {
        $this->order = $order;
        $this->goToPage(1);
    }
}
