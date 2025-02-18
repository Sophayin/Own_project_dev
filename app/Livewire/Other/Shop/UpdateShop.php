<?php

namespace App\Livewire\Other\Shop;

use App\Models\Shop;
use Livewire\Component;

class UpdateShop extends Component
{
    protected $listeners = ['get_edit_shop'];

    public $shop_name, $shop_id, $shop_name_translate, $own_name, $phone, $email, $description;
    public $owner, $telephone, $abbreviation, $facebook_page;
    public $shop;

    protected $rules = [
        'shop_name' => 'required',
        'shop_name_translate' => 'required',
        'owner' => 'required',
        'phone' => 'required',
        'telephone' => 'required',
    ];
    public function messages()
    {
        return [
            'shop_name_translate.required' => 'The shop name (Khmer) field is required',
        ];
    }
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function get_edit_shop($shopId)
    {
        $shop = Shop::find($shopId);
        $this->shop_id = $shopId;
        $this->shop = $shop;
        $this->shop_name = $shop->shop_name;
        $this->shop_name_translate = $shop->shop_name_translate;
        $this->owner = $shop->owner;
        $this->phone = $shop->phone;
        $this->telephone = $shop->telephone;
        $this->email = $shop->email;
        $this->abbreviation = $shop->abbreviation;
        $this->facebook_page = $shop->facebook_page;
        $this->description = $shop->description;
    }


    public function submit_update()
    {
        $this->validate();
        $eshop = Shop::find($this->shop_id);
        $eshop->shop_name = $this->shop_name;
        $eshop->shop_name_translate = $this->shop_name_translate;
        $eshop->owner = $this->owner;
        $eshop->phone = $this->phone;
        $eshop->telephone = $this->telephone;
        $eshop->abbreviation = $this->abbreviation;
        $eshop->facebook_page = $this->facebook_page;
        $eshop->description = $this->description;
        $eshop->creator = Auth()->user()->username;
        $eshop->user_id = Auth()->user()->id;
        $eshop->save();

        $this->dispatch('refresh_shop');
        $this->dispatch('modal.closeModalUpdate');
        $this->dispatch('alert.message', [
            'type' => 'success',
            'message' => __('Successfully updated')
        ]);
    }

    public function render()
    {
        return view('livewire.other.shop.update-shop');
    }
}
