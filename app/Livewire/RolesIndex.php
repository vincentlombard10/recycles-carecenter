<?php

namespace App\Livewire;

use Livewire\Component;
use Spatie\Permission\Models\Role;

class RolesIndex extends Component
{
    public function render()
    {
        $roles = Role::all();
        return view('livewire.roles-index', compact('roles'));
    }
}
