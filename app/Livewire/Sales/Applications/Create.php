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
    public $registration_date;
    protected $listeners = ['onChange'];
    public function messages()
    {
        return [
            "client_name_translate.required" => "The client name (khmer) field is required.",
            'product_id.required' => 'The product field is required',
            'phone.required' => 'The phone field must be at least 6 characters.',
            'city_id.required' => 'The city field is required.',
            'product_price.required' => "The price field is required.",
            'agency_id.required' => "The agency field is required."
        ];
    }
    public function mount()
    {
        $this->registration_date = date('Y-m-d');
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
        $daily_expend->created_at = $this->registration_date . ' ' . date("h:i:s");
        $daily_expend->save();
        // create_transaction_log(__('Created Application') . ' : ' . $this->client_name, 'Created', __('This user created application') . ' ' . $this->client_name . ' ' . __('successfully') . ' ', $this->client_name);
        $this->dispatch('alert.message', [
            'type' => 'success',
            'message' => __("Application was successfully submitted")
        ]);
        $this->resetExcept('registration_date');
        $this->reset();
        $this->dispatch('refresh_application');
    }

    //   Generate Application Code
    public function generate_application_code()
    {
        $application = Application::orderBy('id', 'DESC')->first();
        if ($application) {
            $code = ($application->code + 1);
            $app_code = date('y') . substr($code, 2);
        } else {
            $app_code = date('y') . '0000001';
        }
        return $app_code;
    }

    // Select product & show price
    public function FilterProduct($product_id)
    {
        $product = Product::Find($product_id);
        $this->product_name = $product->title ?? '';
    }

    public function onChange($type, $value)
    {
        if ($type == 'city') {
            $this->city_id = $value;
            $this->district_id = 0;
            $this->commune_id = 0;
        } elseif ($type == 'district') {
            $this->district_id = $value;
            $this->commune_id = 0;
        } elseif ($type == 'commune') {
            $this->commune_id = $value;
        }
        $this->districts = District::where('city_id', $this->city_id)->orderBy('name', 'asc')->get();
        $this->communes = Commune::where('district_id', $this->district_id)->orderBy('name', 'asc')->get();
        $this->villages = Village::where('commune_id', $this->commune_id)->orderBy('name', 'asc')->get();
    }
    // Add Impermanent address
    public function saveAddress()
    {
        $this->city = City::find($this->city_id);
        $this->district = District::find($this->district_id);
        $this->commune = Commune::find($this->commune_id);
        $this->village = Village::find($this->village_id);
    }

    public function addGuarantor()
    {
        $this->guarantor_name = $this->guarantor_name;
        $this->guarantor_name_translate = $this->guarantor_name_translate;
        $this->guarantor_phone = $this->guarantor_phone;
    }

    public function addressModal()
    {
        $this->dispatch('modal.addressModal');
    }
    public function guarantorModal()
    {
        $this->dispatch('modal.guarantorModal');
    }
    // Show Social Media Field
    public function mediaShow()
    {
        $this->facebook = !$this->facebook;
    }
}
