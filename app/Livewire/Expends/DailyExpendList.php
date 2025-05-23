<?php

namespace App\Livewire\Expends;

use App\Models\DailyExpend;
use App\Models\OtherExpense;
use App\Models\TargetExpense;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class DailyExpendList extends Component
{
    use WithPagination;
    public $action;
    public $breakfast;
    public $lunch;
    public $dinner;
    public $amount_coffee;
    public $coffee_price;
    public $party_expend;
    public $amount_gasoline;
    public $gasoline_price;
    public $remark;
    public $expend_date;
    public $start_date;
    public $end_date;
    public $city_id;
    protected $listeners = ['refresh_application' => 'render', 'refresh_application' => 'mount'];
    protected $queryString = ['action', 'application_id'];
    public $target_expend = [];
    public function render()
    {
        $this->action = $this->action;
        $daily_expends = DailyExpend::query();
        $other_expense = OtherExpense::query();
        if ($this->start_date && $this->end_date) {
            $daily_expends = $daily_expends->whereBetween('created_at', [$this->start_date . ' 00:00:00 ', $this->end_date . ' 23:59:59 ']);
        }
        if ($this->start_date && $this->end_date) {
            $other_expense = $other_expense->whereBetween('created_at', [$this->start_date . ' 00:00:00 ', $this->end_date . ' 23:59:59 ']);
        }
        $daily_expends = $daily_expends->orderBy('created_at', 'DESC')->get();
        $other_expense = $other_expense->orderBy('created_at', 'DESC')->get();

        return view('livewire.expends.daily-expend-list', ['daily_expends' => $daily_expends, 'other_expense' => $other_expense])->title('Daily Expense');
    }

    public function btn_add_application()
    {
        $this->dispatch('modal.openModal');
    }
    public $amount, $month;
    public function updatedStartDate()
    {
        $this->end_date = Carbon::parse($this->start_date)->endOfMonth()->toDateString();
        $this->month = Carbon::parse($this->start_date)->startOfMonth()->format('Y-m');
        $target_expend = TargetExpense::where('month', $this->month)->first();
        $this->amount = $target_expend->amount ?? 0;
    }
    public function mount()
    {
        $this->start_date = now()->startOfMonth()->toDateString();
        $this->end_date = now()->endOfMonth()->toDateString();
        $this->expend_date = date('Y-m-d');

        $this->month = Carbon::parse($this->start_date)->startOfMonth()->format('Y-m');
        $target_expend = TargetExpense::where('month', $this->month)->first();
        $this->amount = $target_expend->amount ?? 0;
    }

    public function submit()
    {
        $daily_expend = new DailyExpend();
        $daily_expend->breakfast = $this->breakfast;
        $daily_expend->lunch = $this->lunch;
        $daily_expend->dinner = $this->dinner;
        $daily_expend->amount_coffee = $this->amount_coffee;
        $daily_expend->coffee_price = $this->coffee_price;
        $daily_expend->party_expend = $this->party_expend;
        $daily_expend->gasoline = $this->amount_gasoline;
        $daily_expend->gasoline_price = $this->gasoline_price;
        $daily_expend->remark = $this->remark;
        $daily_expend->created_at = $this->expend_date . ' ' . date("h:i:s");
        $daily_expend->save();
        $this->dispatch('alert.message', [
            'type' => 'success',
            'message' => __("Application was successfully submitted")
        ]);
        $this->resetExcept('expend_date');
        $this->dispatch('modal.closeModal');
        $this->dispatch('refresh_application');
        $this->updatedStartDate();
    }

    public $expend_id;
    public function update_expend($expend_id)
    {
        $this->dispatch('modal.openModalUpdate');
        $this->dispatch('edit_expend', expendId: $expend_id);
    }
}
