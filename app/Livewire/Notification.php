<?php

namespace App\Livewire;

use App\Models\Notification as ModelsNotification;
use Livewire\Component;
use Livewire\WithPagination;

class Notification extends Component
{
    use WithPagination;
    //public $notifications;
    public function render()
    {
        $notifications = ModelsNotification::orderBy('created_at', 'desc');
        $notifications = $notifications->paginate(50);
        return view('livewire.notification', ['notifications' => $notifications]);
    }
}
