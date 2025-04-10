<?php

namespace App\Livewire\Expends;

use App\Models\DailyExpend;
use Livewire\Component;

class UpdateDailyExpend extends Component
{
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
    public $expend_id;
    protected $queryString = ['action', 'application_id'];
    protected $listeners = ['edit_expend'];

    public function render()
    {
        return view('livewire.expends.update-daily-expend');
    }
    public function mount()
    {
        $this->start_date = now()->startOfMonth()->toDateString();
        $this->end_date = now()->endOfMonth()->toDateString();
        $this->expend_date = date('Y-m-d');
    }
    public function edit_expend($expendId)
    {
        $this->expend_id = $expendId;
        $daily_expend = DailyExpend::find($this->expend_id);
        $this->breakfast =  $daily_expend->breakfast;
        $this->lunch = $daily_expend->lunch;
        $this->dinner = $daily_expend->dinner;
        $this->amount_coffee = $daily_expend->amount_coffee;
        $this->coffee_price = $daily_expend->coffee_price;
        $this->party_expend = $daily_expend->party_expend;
        $this->amount_gasoline = $daily_expend->gasoline_price;
        $this->gasoline_price = $daily_expend->gasoline_price;
        $this->remark = $daily_expend->remark;
    }
    public function edit()
    {
        $daily_expend = DailyExpend::find($this->expend_id);
        $daily_expend->breakfast = $this->breakfast;
        $daily_expend->lunch = $this->lunch;
        $daily_expend->dinner = $this->dinner;
        $daily_expend->amount_coffee = $this->amount_coffee;
        $daily_expend->coffee_price = $this->coffee_price;
        $daily_expend->party_expend = $this->party_expend;
        $daily_expend->gasoline = $this->amount_gasoline;
        $daily_expend->gasoline_price = $this->gasoline_price;
        $daily_expend->remark = $this->remark;
        $daily_expend->created_at = $this->expend_date;
        $daily_expend->save();
        $this->dispatch('alert.message', [
            'type' => 'success',
            'message' => __('Application has been successfully updated'),
        ]);
        $this->dispatch('modal.closeModalUpdate');
    }
}
