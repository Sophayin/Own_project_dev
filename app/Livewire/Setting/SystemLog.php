<?php

namespace App\Livewire\Setting;

use App\Models\Position;
use App\Models\TransactionLog;
use Livewire\Component;
use Livewire\WithPagination;

class SystemLog extends Component
{

    use WithPagination;

    public $limit = 15;

    public function render()
    {

        $systemLogs = TransactionLog::orderBy('id', 'DESC');

        $systemLogs = $systemLogs->paginate($this->limit);
        return view('livewire.setting.system-log', ['systemLogs' => $systemLogs]);
    }
}
