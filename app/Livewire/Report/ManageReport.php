<?php

namespace App\Livewire\Report;

use Livewire\Component;

class ManageReport extends Component
{
    public $action;
    public function render()
    {
        return view('livewire.report.manage-report')->title("Report - " . ucfirst($this->action));
    }
    public function mount($slug)
    {
        $this->action = $slug;
    }
}
