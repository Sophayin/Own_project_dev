<?php

namespace App\Livewire\Incomes;

use App\Models\Income;
use Carbon\Carbon;
use Livewire\Component;

class IncomeList extends Component
{
    public $month, $amount, $source, $sent_wife;
    public $remark = "Expense your income wisely";
    public $getting_date, $start_date, $end_date;
    protected $listeners = ['refresh' => 'render'];

    public function mount()
    {
        $this->start_date = now()->startOfMonth()->toDateString();
        $this->end_date = now()->endOfMonth()->toDateString();

        $this->getting_date = Carbon::parse($this->start_date)->startOfMonth()->toDateString();
        $this->remark = $this->remark;
        $this->month = Carbon::parse($this->getting_date)->startOfMonth()->format('Y-m');
    }
    public function updatedStartDate()
    {
        $this->end_date = Carbon::parse($this->start_date)->endOfMonth()->toDateString();
    }

    public function render()
    {
        $monthly_incomes = Income::query();
        if ($this->start_date && $this->end_date) {
            $monthly_incomes = $monthly_incomes->whereBetween('created_at', [$this->start_date . ' 00:00:00', $this->end_date . ' 23:59:59']);
        }
        $monthly_incomes = $monthly_incomes->orderBy('created_at', 'DESC')->get();
        return view('livewire.incomes.income-list', ['monthly_incomes' => $monthly_incomes])->title('Income');
    }
    public function set_expend()
    {
        $this->dispatch('modal.openModal');
    }

    public function set_expend_target()
    {
        $income = new Income();
        $income->source = $this->source;
        $income->amount = $this->amount;
        $income->sent_wife = $this->sent_wife;
        $income->remark = $this->remark;
        $income->month = $this->month;
        $income->created_at = $this->getting_date . ' ' . date("h:i:s");
        $income->save();
        $this->dispatch('alert.message', [
            'type' => 'success',
            'message' => __("Record income successfully")
        ]);
        $this->reset();
        $this->dispatch('modal.closeModal');
        $this->dispatch('refresh');
    }
}
