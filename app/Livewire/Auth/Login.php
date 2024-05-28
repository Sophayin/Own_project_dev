<?php

namespace App\Livewire\Auth;

use App\Models\Department;
use App\Models\Permission;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
    public $username, $password, $remember_me;
    public $msgInvalidCredential = '';
    protected $rules = [
        'username' => 'required',
        'password' => 'required',
    ];

    public function __construct()
    {
        if (Auth::check()) {
            $this->redirect(url('/'), navigate: true);
        }
    }
    public function mount()
    {
        if (Auth::check()) {
            $this->redirect(url('/'), navigate: true);
        }
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        return view('livewire.auth.login')->layout('layouts.frontend')->title("Login - " . env('APP_NAME'));
    }

    public function doLogin()
    {
        $this->validate();
        if (Auth::attempt(['username' => $this->username, 'password' => $this->password], $this->remember_me)) {

            if (Auth::user()->role_user) {
                $role_id = Auth::user()->role_user->role_id;
            } else {
                $role_id = Auth::user()->staff->role_id;
            }

            $departments = Department::whereHas('role_permission', function ($q) use ($role_id) {
                $q->where('role_id', $role_id);
            })->whereNotNull('parent_id')->with('recursive_agency')
                ->get();
            $data_permission = [];
            foreach ($departments as $item) {
                $data_action = [];
                foreach ($item->role_permission->where('role_id', $role_id) as $item_l) {
                    $data_action = Permission::where('department_id', $item->id)->whereIn('id', json_decode($item_l->permission, true))->pluck('action')->toArray();
                }
                $data_permission[$item->name] = $data_action;
            }
            session(['user_permission' => $data_permission]);
            create_transaction_log(Auth::user()->name . ' : ' . Auth::user()->name, 'Success', __('logined success') . ' ' . Auth::user()->name . ' ' . __('successfully') . ' ', Auth::user()->name);

            return redirect()->route('dashboard');
            $this->dispatch('user.alert', [
                'type' => 'success',
                'message' => "success",
                'link'  =>  redirect()->route('dashboard'),
            ]);
        } else {
            $this->msgInvalidCredential = 'Invalid credential. Please try again or contact support if you are unable to access your account';
        }
    }
}
