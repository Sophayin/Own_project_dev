<?php

namespace App\Livewire\Users\Role;

use App\Models\Role;
use Livewire\Component;

class RoleCreate extends Component
{
    public $name, $description, $role_status = 1;
    public function render()
    {
        return view('livewire.users.role.role-create');
    }
    protected $rules = [
        'name' => 'required',
        'role_status' => 'required'
    ];
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function createRole()
    {
        $this->validate();
        $errors = $this->getErrorBag();
        if (check_role_name_exist('name', $this->name)) {
            $errors->add('name', 'The ' . $this->name . ' already exist');
        }
        if (count($errors)) {
            return $errors;
        }
        $role = new Role();
        $role->name = $this->name;
        $role->description = $this->description;
        $role->status = $this->role_status;
        $role->save();

        $this->dispatch("alert.message", [
            'type' => 'success',
            'message' => $this->name . " " . __("Successfully created")
        ]);
        $this->dispatch('modal.closeModal');
        $this->dispatch('refresh_role');
    }
}
