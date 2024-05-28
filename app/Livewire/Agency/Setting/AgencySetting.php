<?php

namespace App\Livewire\Agency\Setting;

use App\Models\AgencySetting as ModelsAgencySetting;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AgencySetting extends Component
{
    public $prop, $label, $valueInput, $override_fee;

    public function mount()
    {
        $data = ModelsAgencySetting::first();
        if ($this->prop === 'commission_fee') {
            $this->label = 'Commission Fee';
            $this->valueInput = isset($data->commission_fee) ? $data->commission_fee : '';
            $this->override_fee = $data->override_fee;

            create_transaction_log('update commission fee', 'update', 'Update commission fee to ' . $data->commission_fee, Auth::user()->name);
        } else {

            $this->label = 'Period of Expiration';
            $this->valueInput = isset($data->period_expiration) ? $data->period_expiration : '';

            create_transaction_log('update period of expiration', 'update', 'Update successfully', Auth::user()->name);
        }
    }

    public function render()
    {
        return view('livewire.agency.setting.agency-setting');
    }

    protected $rules = [
        'valueInput' => 'required',
        'override_fee' => 'required'
    ];

    public function update()
    {
        $this->validate();
        $data = \App\Models\AgencySetting::first();
        if ($this->prop == 'commission_fee') {
            $data->commission_fee = $this->valueInput;
            $data->override_fee = $this->override_fee ?? 0;
        } else {
            $data->period_expiration = $this->valueInput;
        }
        $data->save();
        create_transaction_log('Update : ' . $this->valueInput, 'update',  'Update ' . $this->valueInput, $this->valueInput);
        $this->dispatch("alert.message", [
            'type' => 'success',
            'message' => __("Successfully updated")
        ]);
    }
}
