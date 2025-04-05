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

class Create extends Component
{
    use WithFileUploads;

    public $breakfast, $lunch, $dinner, $amount_coffee, $coffee_price, $party_expend, $amount_gasoline, $gasoline_price, $remark, $expend_date;

    public $app_code;
    public $loan_company_id = 0;
    public $respond_by;
    public $cities = [];
    public $districts = [];
    public $communes = [];
    public $villages = [];
    public $city, $district, $commune, $village;
    public $city_id;
    public $district_id;
    public $village_id;
    public $commune_id;
    public $occupations;
    public $shops = [];
    public $products = [];
    public $agencies = [];
    public $product = [];
    public $address = false;
    public $guarantor = false;
    public $application = [];
    public $applicationstatus = '';
    public $house_no, $street_no;
    public $leader;
    public $facebook = false;
    public $code;
    public $agency;
    public $leader_code;
    protected $listeners = ['onChange'];

    public function mount()
    {
        $this->expend_date = date('Y-m-d');
    }

    public function render()
    {
        $this->dispatch('loadAgency');
        $this->products = Product::all();
        $this->shops = Shop::all();
        $this->occupations = Occupation::all();
        $this->agencies = Agency::whereNotNull('code')->whereIn('status', [1, 2])->get();
        $this->cities = City::orderBy('name', 'asc')->get();
        return view('livewire.sales.applications.create');
    }

    public function submit()
    {
        $daily_expend = new Application();
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
        // create_transaction_log(__('Created Application') . ' : ' . $this->client_name, 'Created', __('This user created application') . ' ' . $this->client_name . ' ' . __('successfully') . ' ', $this->client_name);
        $this->dispatch('alert.message', [
            'type' => 'success',
            'message' => __("Application was successfully submitted")
        ]);
        $this->resetExcept('expend_date');
        $this->reset();
        $this->dispatch('refresh_application');
    }
}
