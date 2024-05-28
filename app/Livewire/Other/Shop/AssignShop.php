<?php

namespace App\Livewire\Other\Shop;

use App\Models\Agency;
use App\Models\Shop;
use App\Models\ShopAgency;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class AssignShop extends Component
{
    public function render()
    {
        $this->dispatch('loadShop');
        return view('livewire.other.shop.assign-shop');
    }

    protected $listeners = ['assign_shop'];
    public $shops = [], $shop_ids = [];
    public $agency;

    public function assign_shop($agencyId)
    {
        $this->agency = Agency::find($agencyId);
        if ($this->agency->agency_shop) {
            $this->shop_ids = array_unique($this->agency->agency_shop->pluck('shop_id')->toArray());
        } else {
            $this->shop_ids = [];
        }
    }
    protected $rules  = [
        'shop_ids' => 'required'
    ];
    public function messages()
    {
        return [
            'shop_ids.required' => 'The Shop name field is required.',
        ];
    }
    public function __construct()
    {
        $this->shops = Shop::where('status', 1)->orderBy('shop_name', 'asc')->get();
    }

    public function submit_add_shop()
    {
        $this->validate();
        DB::table('shop_agencies')->where('agency_id', $this->agency->id)->delete();
        foreach ($this->shop_ids as $key => $item) {
            $shop_agency = new ShopAgency();
            $shop_agency->agency_id = $this->agency->id;
            $shop_agency->shop_id = $item;
            $shop_agency->creator = Auth::user()->name;
            $shop_agency->save();
        }
        $this->dispatch('alert.message', [
            'type' => 'success',
            'message' => __('Successfully created')
        ]);
        $this->dispatch('modal.closeModal');
        $this->dispatch('refresh_shop');
        $this->reset();
    }
}
