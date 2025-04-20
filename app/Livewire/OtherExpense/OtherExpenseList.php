<?php

namespace App\Livewire\OtherExpense;

use App\Models\OtherExpense;
use Livewire\Component;

class OtherExpenseList extends Component
{
    public $cloth;
    public $cloth_price;
    public $accessary;
    public $accessary_price;
    public $event;
    public $event_expense;
    public $taxi;
    public $taxi_fee;
    public $remark;
    public $expend_date;
    public $other_expends = [];
    public $expand_date, $start_date, $end_date;

    public function mount()
    {
        $this->expend_date = date('Y-m-d');
        $this->start_date = now()->startOfMonth()->toDateString();
        $this->end_date = now()->endOfMonth()->toDateString();
    }
    public function render()
    {
        $this->other_expends = OtherExpense::orderBy('created_at', 'DESC')->get();
        return view('livewire.other-expense.other-expense-list');
    }
    public function btn_add_application()
    {
        $this->dispatch('modal.openModal');
    }
    public function submit()
    {
        $other_expend = new OtherExpense();
        $other_expend->cloth = $this->cloth;
        $other_expend->cloth_price = $this->cloth_price;
        $other_expend->accessary = $this->accessary;
        $other_expend->accessary_price = $this->accessary_price;
        $other_expend->event = $this->event;
        $other_expend->event_expense = $this->event_expense;
        $other_expend->taxi = $this->taxi;
        $other_expend->taxi_fee = $this->taxi_fee;
        $other_expend->remark = $this->remark;
        $other_expend->created_at = $this->expend_date . ' ' . date("h:i:s");
        $other_expend->save();
        $this->dispatch('alert.message', [
            'type' => 'success',
            'message' => __("Expend was successfully submitted")
        ]);
        $this->dispatch('modal.closeModal');
    }

    public $expend_id;
    public function update_other_expend($expend_id)
    {
        $this->dispatch('modal.openModalUpdate');
        $this->dispatch('edit_other_expend', expendId: $expend_id);
    }
}
