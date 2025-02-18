<?php

namespace App\Livewire\Users\Staff;

use App\Models\Staff;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class StaffList extends Component
{
    use WithPagination;
    public $limit = 15, $column_name = 'name', $sort = 'desc';
    public $search;
    public function render()
    {
        $staff = Staff::orderBy('id', 'ASC');
        $staff = $staff->paginate($this->limit);
        return view('livewire.users.staff.staff-list', ['staff' => $staff]);
    }

    protected $listeners = ['refresh_staff' => 'render'];
    public function open_modal_register()
    {
        if (in_array('Create User', session('user_permission')['User'])) {
            $this->dispatch('modal.openModal');
        } else {
            $this->dispatch("alert.message", [
                'type' => 'warning',
                'message' => __("Access Denied! You don't have permission to access this function. Request access from your administrator")
            ]);
        }
    }

    public function edit_user($id)
    {
        if (in_array('Edit User', session('user_permission')['User'])) {
            $this->dispatch('edit_user', userId: $id);
            $this->dispatch('modal.openModalUpdate');
        } else {
            $this->dispatch("alert.message", [
                'type' => 'warning',
                'message' => __("Access Denied! You don't have permission to access this function. Request access from your administrator")
            ]);
        }
    }

    public function edit_current_password($id)
    {
        if (in_array('Change Password', session('user_permission')['User'])) {
            $this->dispatch('edit_current_password', userId: $id);
            $this->dispatch('modal.openModalChangePassword');
        } else {
            $this->dispatch("alert.message", [
                'type' => 'warning',
                'message' => __("Access Denied! You don't have permission to access this function. Request access from your administrator")
            ]);
        }
    }
}
