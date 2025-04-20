<?php

namespace App\Livewire\OtherExpense;

use App\Models\OtherExpense;
use Livewire\Component;

class UpdateOtherExpense extends Component
{
    public $start_date, $end_date, $expend_date, $other_expend_date;
    public $other_expend_id;
    public $cloth, $cloth_price, $accessary, $accessary_price, $event, $event_expend, $taxi, $taxi_fee, $remark;
    protected $listeners = ['edit_other_expend'];

    public function render()
    {
        return view('livewire.other-expense.update-other-expense');
    }
    public function mount()
    {
        $this->start_date = now()->startOfMonth()->toDateString();
        $this->end_date = now()->endOfMonth()->toDateString();
    }
    public function edit_other_expend($expendId)
    {
        $this->other_expend_id = $expendId;
        $other_expend = OtherExpense::find($this->other_expend_id);
        $this->cloth = $other_expend->cloth;
        $this->cloth_price = $other_expend->cloth_price;
        $this->accessary = $other_expend->accessary;
        $this->accessary_price = $other_expend->accessary_price;
        $this->event = $other_expend->event;
        $this->event_expend = $other_expend->event_expend;
        $this->taxi = $other_expend->taxi;
        $this->taxi_fee = $other_expend->taxi_fee;
        $this->remark = $other_expend->remark;
        $this->other_expend_date = $other_expend->created_at->format('Y-m-d');
    }
    public function update_other_expend()
    {
        $other_expend = OtherExpense::find($this->other_expend_id);
        $other_expend->cloth = $this->cloth;
        $other_expend->cloth_price = $this->cloth_price;
        $other_expend->accessary = $this->accessary;
        $other_expend->accessary_price = $this->accessary_price;
        $other_expend->event = $this->event;
        $other_expend->event_expense = $this->event_expense;
        $other_expend->taxi = $this->taxi;
        $other_expend->taxi_fee = $this->taxi_fee;
        $other_expend->remark = $this->remark;
        $other_expend->created_at = $this->other_expend_date;
        $other_expend->save();
        $this->dispatch('alert.message', [
            'type' => 'success',
            'message' => __("Other expend was successfully updated")
        ]);
        $this->dispatch('modal.closeModalUpdate');
    }
}
