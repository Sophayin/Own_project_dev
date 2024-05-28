<?php

namespace App\Livewire\HRM;

use Livewire\Component;

class PayrollStatus extends Component
{
    public function render()
    {
        return view('livewire.h-r-m.payroll-status');
    }

    public $label;

    public function statusChange($selectedStatus)
    {
        if ($selectedStatus == 0) {
            $this->label = 'Rejected By';
        } else {
            $this->label = 'Approved By';
        }
    }
}
