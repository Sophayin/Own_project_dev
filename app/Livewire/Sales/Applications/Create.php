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

    public $agency_id, $shop_name, $client_name, $condition, $income,
        $client_name_translate, $phone, $product_name, $gender = "Male",
        $product_price, $occupation, $guarantor_name, $guarantor_name_translate,
        $guarantor_phone, $reason, $client_profile, $client_address, $title,
        $status = 1, $client_facebook, $product_id, $agency_code, $latitude, $longitude,
        $khmer_identity_card;

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
    protected $rules = [
        'shop_name' => 'required',
        'client_name_translate' => 'required|string|max: 255',
        'phone' => 'required|string|min:6',
        'occupation' => 'required',
        'income' => 'required',
        'product_id' => 'required',
        'condition' => 'required',
        'product_price' => 'required',
        'city_id' => 'required',
        'agency_id' => 'required',
    ];
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

    public function updated($propertyName)
    {
        $agency = Agency::find($this->agency_id);
        $this->agency_id = $this->agency_id;
        $this->agency_code = $agency->code ?? '';
        if ($agency) {
            $this->leader = $agency->parent;
            $this->leader_code = $agency->parent->code ?? '';
        } else {
            $this->agency_code = '';
            $this->leader_code = '';
            $this->leader = null;
        }
        $this->validateOnly($propertyName);
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
        $this->validate();
        $create = new Application();
        $create->code = $this->generate_application_code();
        $create->agency_id = $this->agency_id;
        $create->agency_code = $this->agency_code;
        $create->agency_leader_code = $this->leader_code;
        $create->client_name = $this->client_name;
        $create->client_name_translate = $this->client_name_translate;
        $create->gender = $this->gender;
        $create->phone = $this->phone;
        $create->khmer_identity_card = $this->khmer_identity_card;
        $create->occupation_id = $this->occupation;
        $create->income = $this->income;
        $create->shop_id = $this->shop_name;
        $create->condition = $this->condition;
        $create->product_id = $this->product_id;
        $create->product_name = $this->product_name;
        $create->product_price = $this->product_price;
        $create->guarantor_name = $this->guarantor_name;
        $create->guarantor_name_translate = $this->guarantor_name_translate;
        $create->guarantor_phone = $this->guarantor_phone;
        $create->status = $this->status;
        $create->loan_company_id = $this->loan_company_id;
        $create->respond_by = $this->respond_by;
        $create->client_facebook = $this->client_facebook;
        $create->created_by = Auth()->user()->username;
        $create->created_at = $this->registration_date . ' ' . date("h:i:s");
        if ($create->save()) {
            $address = new Address;
            $address->city_id = $this->city_id;
            $address->district_id = $this->district_id;
            $address->commune_id = $this->commune_id;
            $address->village_id = $this->village_id;
            $address->house_no = $this->house_no;
            $address->street_no = $this->street_no;
            $address->latitude = $this->latitude;
            $address->longitude = $this->longitude;
            $address->application_id = $create['id'];
            $address->save();
        }

        create_transaction_log(__('Created Application') . ' : ' . $this->client_name, 'Created', __('This user created application') . ' ' . $this->client_name . ' ' . __('successfully') . ' ', $this->client_name);
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
