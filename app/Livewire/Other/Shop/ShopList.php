<?php

namespace App\Livewire\Other\Shop;

use App\Models\Shop;
use Illuminate\Cache\RateLimiting\Limit;
use Livewire\Component;
use Livewire\WithPagination;

class ShopList extends Component
{
    use WithPagination;
    public $limit = 10;
    public $search;
    protected $listeners = ['refresh_shop' => 'render'];

    public function render()
    {
        $shop_list = Shop::query();
        if ($this->search) {
            $shop_list = $shop_list->where('shop_name', 'ilike', '%' . $this->search . '%')
                ->orWhere('abbreviation', 'ilike', '%' . $this->search . '%')
                ->orWhere('shop_name_translate', 'ilike', '%' . $this->search . '%')
                ->orWhere('phone', 'ilike', '%' . $this->search . '%');
        }
        $shop_list = $shop_list->paginate($this->limit);
        return view('livewire.other.shop.shop-list', ['shop_list' => $shop_list])->title('Shop-list');
    }
    //--open add new shop pop up--
    public function addShops()
    {
        if (in_array('Create Shop', session('user_permission')['Shop'])) {
            $this->dispatch('modal.openModal');
        } else {
            $this->dispatch("alert.message", [
                'type' => 'warning',
                'message' => __("Access Denied! You don't have permission to access this function. Request access from your administrator")
            ]);
        }
    }
    //--open update shop pop up--
    public function get_edit_shop($id)
    {
        if (in_array('Edit Shop', session('user_permission')['Shop'])) {
            $this->dispatch('get_edit_shop', shopId: $id);
            $this->dispatch('modal.openModalUpdate');
        } else {
            $this->dispatch("alert.message", [
                'type' => 'warning',
                'message' => __("Access Denied! You don't have permission to access this function. Request access from your administrator")
            ]);
        }
    }
}
