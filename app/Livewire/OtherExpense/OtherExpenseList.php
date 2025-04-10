<?php

namespace App\Livewire\OtherExpense;

use Livewire\Component;

class OtherExpenseList extends Component
{
    public function render()
    {
        return view('livewire.other-expense.other-expense-list');
    }
    public function btn_add_application()
    {
        $this->dispatch('modal.openModal');
    }
}