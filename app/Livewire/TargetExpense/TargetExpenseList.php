<?php

namespace App\Livewire\TargetExpense;

use App\Models\TargetExpense;
use Carbon\Carbon;
use Livewire\Component;

class TargetExpenseList extends Component
{
    public $month, $amount;
    public $remark = "Don't waste your money with useless asset.";
    public $monthly_targets = [];
    public $start_date;
    public function render()
    {
        $this->monthly_targets = TargetExpense::orderBy('month', 'asc')->get();
        return view('livewire.target-expense.target-expense-list', ['$monthly_targets' => $this->monthly_targets])->title('Target Expense');
    }
    public function set_expend()
    {
        $this->dispatch('modal.openModal');
    }
    public function mount()
    {
        $this->start_date = now()->startOfMonth()->toDateString();
        $this->remark = $this->remark;
        $this->month = Carbon::parse($this->start_date)->startOfMonth()->format('Y-m');
    }
    public function set_expend_target()
    {
        $set_target = new TargetExpense();
        $set_target->month = $this->month;
        $set_target->amount = $this->amount;
        $set_target->remark = $this->remark;
        $set_target->save();
        $this->dispatch('alert.message', [
            'type' => 'success',
            'message' => __("Set expens target uccessfully")
        ]);
        $this->reset();
        $this->dispatch('modal.closeModal');
    }
}
