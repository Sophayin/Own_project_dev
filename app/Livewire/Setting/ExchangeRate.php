<?php

namespace App\Livewire\Setting;

use App\Models\AgencySetting as ModelsAgencySetting;
use App\Models\ExchangeRate as ModelsExchangeRate;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ExchangeRate extends Component
{
    public $rate;
    public $price = 1;
    public $currency = "";

    public function render()
    {
        $exchange_rate = ModelsExchangeRate::orderBy('created_at', 'DESC')->paginate(25);
        return view('livewire.setting.exchange-rate', ['exchange_rate' => $exchange_rate]);
    }

    public function mount()
    {
        $data = ModelsAgencySetting::first();
        $this->rate = $data->exchange_rate;
    }
    protected $rules = [
        'rate' => 'required',
        'price' => 'required',
    ];

    public function save()
    {
        $this->validate();
        $data = ModelsAgencySetting::first();
        $data->exchange_rate = $this->rate;
        $data->save();
        $rate = new ModelsExchangeRate();
        $rate->price = $this->price;
        $rate->currency = $this->currency;
        $rate->rate = $this->rate;
        $rate->save();
        create_transaction_log('update exchange rate', 'update', $this->price . '=' . $this->rate, Auth::user()->name);
        $this->dispatch("alert.message", [
            'type' => 'success',
            'message' => __("Successfully updated")
        ]);
    }
}
