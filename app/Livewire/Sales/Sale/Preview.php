<?php

namespace App\Livewire\Sales\Sale;

use App\Models\Application;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Preview extends Component
{
    protected $listener = ['previewSelecte'];
    public $applications = [];
    public $selected_application_ids;
    public $position_name;
    public function render()
    {
        return view('livewire.sales.sale.preview')->layout('layouts.frontend')->title("Sale Preview");
    }
    public function mount()
    {

        $this->selected_application_ids = Session::get('selected_application_ids');
        if (is_null($this->selected_application_ids))
            return $this->redirect('sale/list', navigate: true);

        //$this->payrolls = PayrollDetail::whereIn('id', $this->selected_application_ids)->get();
        //$this->position_name = $this->payrolls->pluck('agency.position.abbreviation')->unique()->implode('/');
        //dd($this->selected_application_ids);
        $this->applications = Application::whereIn('id', $this->selected_application_ids)->get();
    }
}
