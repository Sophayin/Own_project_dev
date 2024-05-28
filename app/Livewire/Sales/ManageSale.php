<?php

namespace App\Livewire\Sales;

use Livewire\Component;

class ManageSale extends Component
{

    public $action = 'list';

    public function render()
    {
        return view('livewire.sales.manage-sale')->title("Sale - " . ucfirst($this->action));
    }
    public function mount($slug)
    {
        $this->action = $slug;
    }
}
