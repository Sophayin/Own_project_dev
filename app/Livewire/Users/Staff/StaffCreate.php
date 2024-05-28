<?php

namespace App\Livewire\Users\Staff;

use App\Models\Role;
use App\Models\Staff;
use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;

class StaffCreate extends Component
{
    use WithFileUploads;

    public function render()
    {
        $this->roles = Role::where('id', '!=', 1)->orderBy('name', 'ASC')->get();
        return view('livewire.users.staff.staff-create');
    }
    public $roles = [];
    public $profile, $name, $username, $phone, $password, $password_confirmation, $email, $role_id;
    protected $rules = [
        'name' => 'required',
        'username' => 'required|min:3',
        'email' => ['required', 'email'],
        'phone' => 'required',
        'password' => 'required|confirmed|min:6',
        'password_confirmation' => 'required|same:password|min:6',
        'role_id' => 'required'
    ];
    public function messages()
    {
        return [
            'role_id.required' => 'The role field is required.',
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function createUser()
    {
        $this->validate();
        $errors = $this->getErrorBag();
        if (check_user_exist('email', $this->email)) {
            $errors->add('email', 'The Email already exist');
        }
        if (check_user_exist('phone', $this->phone)) {
            $errors->add('phone', 'The Phone already exist');
        }
        if (check_user_exist('username', $this->username)) {
            $errors->add('username', 'The Username already exist');
        }
        if (count($errors)) {
            return $errors;
        }
        $user = new User();
        $user->name = $this->name;
        $user->username = $this->username;
        $user->email = $this->email;
        $user->phone = $this->phone;
        $user->password = bcrypt($this->password);
        if ($this->profile) {
            $user->profile = $this->profile->store('photos');
        }
        if ($user->save()) {
            $staff = new Staff();
            $staff->user_id = $user->id;
            $staff->role_id = $this->role_id;
            $staff->save();
        }
        $this->dispatch("alert.message", [
            'type' => 'success',
            'message' => $this->name . ' ' . __("Successfully created")
        ]);
        $this->dispatch('modal.closeModal');
        $this->dispatch('refresh_staff');
    }
}
