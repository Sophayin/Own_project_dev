<?php

namespace App\Livewire\Users\Staff;

use App\Models\Staff;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class UserProfile extends Component
{
    use WithFileUploads;
    public $profile;
    public $user, $name, $username, $email, $phone, $role_id, $staff, $type;
    public $id;
    public function mount()
    {
        $this->user = User::find($this->id);
        $this->name = Auth::user()->name;
        $this->email = Auth::user()->email;
        $this->username = Auth::user()->username;
        $this->phone = Auth::user()->phone;
        $this->type = Auth::user()->type;
    }
    public function render()
    {
        return view('livewire.users.staff.user-profile');
    }
    public function updateProfile()
    {
        $user = User::find($this->id);
        $user->name = $this->name;
        //$user->username = $this->username;
        $user->email = $this->email;
        $user->phone = $this->phone;
        //$user->role_id = $this->role_id;

        if ($this->profile) {
            $user->profile = $this->profile->store('photos');
        }
        $user->save();
        $this->dispatch('alert.message', [
            'type' => 'success',
            'message' => __('Successfully updated')
        ]);
    }
}
