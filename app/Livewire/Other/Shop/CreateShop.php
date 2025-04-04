<?php

namespace App\Livewire\Other\Shop;

use App\Models\Shop;
use Livewire\Component;

class CreateShop extends Component
{
    public $shop_name, $owner, $phone, $telephone, $email, $abbreviation,
        $facebook_page, $description;
    public $shop_name_translate;
    public function render()
    {
        return view('livewire.other.shop.create-shop');
    }
    protected $rules = [
        'shop_name' => 'required',
        'shop_name_translate' => 'required',
        'owner' => 'required',
        'phone' => 'required',
        'telephone' => 'required',
    ];
    public function createShop()
    {
        $this->validate();
        $shops = new Shop();
        $shops->shop_name = $this->shop_name;
        $shops->shop_name_translate = $this->shop_name_translate;
        $shops->owner = $this->owner;
        $shops->phone = $this->phone;
        $shops->telephone = $this->telephone;
        $shops->abbreviation = $this->abbreviation;
        $shops->facebook_page = $this->facebook_page;
        $shops->description = $this->description;
        $shops->creator = Auth()->user()->username;
        $shops->user_id = Auth()->user()->id;
        $shops->save();
        $this->dispatch('alert.message', [
            'type' => 'success',
            'message' => __('Successfully created')
        ]);
        $this->dispatch('modal.closeModal');
        $this->dispatch('refresh_shop');
        $this->reset();
    }
    public function messages()
    {
        return [
            'shop_name_translate.name.required' => 'The shop name field is required.',
        ];
    }
}
