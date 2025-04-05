<?php

namespace App\Livewire\Sales\Applications;

use App\Models\Address;
use App\Models\Agency;
use App\Models\Application;
use App\Models\City;
use App\Models\Commune;
use App\Models\District;
use App\Models\Occupation;
use App\Models\Product;
use App\Models\Shop;
use App\Models\Village;
use Livewire\Component;
use Livewire\WithFileUploads;

class Update extends Component
{
    use WithFileUploads;
    public $breakfast, $lunch, $dinner, $amount_coffee, $coffee_price, $party_expend, $amount_gasoline, $gasoline_price, $remark, $expend_date;
    public $application_id;
    public function mount()
    {
        $daily_expend = Application::find($this->application_id);
        $this->breakfast =  $daily_expend->breakfast;
        $this->lunch = $daily_expend->lunch;
        $this->dinner = $daily_expend->dinner;
        $this->amount_coffee = $daily_expend->amount_coffee;
        $this->coffee_price = $daily_expend->coffee_price;
        $this->party_expend = $daily_expend->party_expend;
        $this->amount_gasoline = $daily_expend->gasoline_price;
        $this->gasoline_price = $daily_expend->gasoline_price;
        $this->remark = $daily_expend->remark;
        $this->expend_date = $daily_expend->created_at->format('Y-m-d');
    }

    public function edit()
    {
        $daily_expend = Application::find($this->application_id);
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
    }

    public function addressModal()
    {
        $this->dispatch('modal.addressModal');
    }
    public function guarantorModal()
    {
        $this->dispatch('modal.guarantorModal');
    }

    public function render()
    {
        $this->dispatch('loadAgency');
        return view('livewire.sales.applications.update');
    }
}
