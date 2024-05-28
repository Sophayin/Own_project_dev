<?php

namespace App\Livewire\Users\Staff;

use App\Models\Role;
use App\Models\Staff;
use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;

class StaffUpdate extends Component
{
    use WithFileUploads;
    public $roles = [];
    public function render()
    {
        $this->roles = Role::where('id', '!=', 1)->get();
        return view('livewire.users.staff.staff-update');
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public $user, $staff, $old_profile, $profile, $name, $username, $phone, $email, $role_id;
    protected $listeners = ['edit_user'];
    protected $rules = [
        'profile.*' => 'image|max:1024',
        'name'  => 'required',
        'username' => 'required|min:3',
        'email' => 'required|email',
        'phone' => 'required',
        'role_id'  => 'required'
    ];

    public function messages()
    {
        return [
            'role_id.required' => 'The role field is required.',
        ];
    }


    public function edit_user($userId)
    {
        $user = User::find($userId);
        $this->user = $user;
        $this->staff = $user->staff;

        $this->name = $this->user->name;
        $this->username = $this->user->username;
        $this->email = $this->user->email;
        $this->phone = $this->user->phone;
        $this->role_id = $user->staff->role_id;
        $this->old_profile = $this->user->profile;
    }

    public function updateUser()
    {
        $this->validate();
        $user = User::find($this->user->id);
        $user->name = $this->name;
        $user->username = $this->username;
        $user->email = $this->email;
        $user->phone = $this->phone;
        $user->role_id = $this->role_id;
        if ($this->profile) {
            $user->profile = $this->profile->store('photos');
        }
        if ($user->save()) {
            $staff = Staff::where('user_id', $this->user->id)->first();
            $staff->role_id = $this->role_id;
            $staff->save();
        }
        $this->dispatch("alert.message", [
            'type' => 'success',
            'message' => $this->name . " " . __("Successfully updated")
        ]);
        $this->dispatch('modal.closeModalUpdate');
        $this->dispatch('refresh_staff');
    }
}
