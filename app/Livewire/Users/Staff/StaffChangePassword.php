<?php

namespace App\Livewire\Users\Staff;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class StaffChangePassword extends Component
{
    public function render()
    {
        return view('livewire.users.staff.staff-change-password');
    }
    public $id, $current_password, $password, $password_confirmation;
    protected $listeners = ['edit_current_password'];
    protected $rules = [
        'current_password' => 'required',
        'password' => 'required|confirmed|min:6',
        'password_confirmation' => 'required_with:password|same:password|min:6',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function edit_current_password($userId)
    {
        $this->id = $userId;
    }

    public function changeUserPassword()
    {
        $this->validate();
        $errors = $this->getErrorBag();
        $user = User::find($this->id);
        if (!Hash::check($this->current_password, $user->password)) {
            $errors->add('current_password', 'Current Password is invalid');
        }
        if (count($errors)) {
            return $errors;
        }
        $user->password = $this->password;
        $user->save();
        $this->dispatch("alert.message", [
            'type' => 'success',
            'message' => __("Password Successfully Changed")
        ]);
        $this->dispatch('modal.closeModalChangePassword');
    }
}
