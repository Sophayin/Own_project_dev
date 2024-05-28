<?php

namespace App\Livewire\Agency\Register;

use App\Models\Address;
use App\Models\Agency;
use App\Models\City;
use App\Models\Commune;
use App\Models\District;
use App\Models\Occupation;
use App\Models\Village;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class AgencyRegister extends Component
{
    public $city_id, $district_id, $commune_id, $village_id;
    public $cities, $districts, $communes, $villages;
    public $profile, $khmer_identity_card, $full_name, $full_name_translate, $referrer_code,
        $age, $phone, $phone_telegram, $gender = 'Male',
        $remark, $bank_account, $income, $occupation_id, $house_no, $street_no, $company;

    public $code, $bank_name, $account_name, $account_number;
    public $occupations;

    public $bank_info = ['status' => 1, 'bank_name' => '', 'account_name' => '', 'account_number' => ''];
    public $date_of_birth = [];
    public $selectedYear;

    protected $rules = [
        'full_name' => 'required|string|min:2|max:255',
        'full_name_translate' => 'required|string|min:2|max:255',
        'phone' => 'required|string|min:6',
        'khmer_identity_card' => 'required|string',
        'occupation_id' => 'required',
        'age' => 'required',
        'income' => 'required',
        'referrer_code' => 'required'
    ];
    public function messages()
    {
        return [
            'full_name_translate.required' => 'The full name (English) field is required.',
            'full_name.required' => 'The full name (Khmer) field is required.',

        ];
    }
    protected $queryString = ['referrer_code'];
    protected $listeners = ['refresh-page' => 'refresh'];

    public function register()
    {
        $this->validate();
        $agency = new Agency();
        $agency->code = $this->code;
        $agency->agency_profile = null;
        $agency->position_id = 5;
        $agency->khmer_identity_card = $this->khmer_identity_card;
        $agency->full_name = $this->full_name;
        $agency->full_name_translate = $this->full_name_translate;
        $agency->age = $this->age;
        $agency->phone = $this->phone;
        $agency->phone_telegram = $this->phone_telegram;
        $agency->income = $this->income;
        $agency->gender = $this->gender;
        $agency->remark = $this->remark;
        $agency->occupation_id = $this->occupation_id;
        $agency->bank_info = json_encode($this->bank_info, JSON_UNESCAPED_UNICODE);
        $agency->date_of_birth = json_encode($this->date_of_birth);
        $agency->status = 3;
        $agency->referrer_code = $this->referrer_code;
        $agency->company = $this->company;
        $agency->registered_date = date("Y-m-d h:i:s");
        if ($agency->save()) {
            $address = new Address();
            $address->city_id = $this->city_id;
            $address->district_id = $this->district_id;
            $address->commune_id = $this->commune_id;
            $address->village_id = $this->village_id;
            $address->house_no = $this->house_no;
            $address->street_no = $this->street_no;
            $address->agency_id = $agency['id'];
            $address->save();
        }
        $this->dispatch('alert.message', [
            'type' => 'success',
            'message' => __("Successfully created")
        ]);

        $this->reset(
            'code',
            'khmer_identity_card',
            'full_name',
            'full_name_translate',
            'age',
            'gender',
            'phone',
            'phone_telegram',
            'income',
            'remark',
            'city_id',
            'district_id',
            'commune_id',
            'village_id',
            'remark',
            'occupation_id',
            'income',
            'house_no',
            'street_no',
            'company',
            'referrer_code',
            'bank_info'
        );
    }

    public function cancel()
    {
        $this->reset(
            'code',
            'khmer_identity_card',
            'full_name',
            'full_name_translate',
            'age',
            'gender',
            'phone',
            'phone_telegram',
            'income',
            'remark',
            'city_id',
            'district_id',
            'commune_id',
            'village_id',
            'remark',
            'occupation_id',
            'income',
            'house_no',
            'street_no',
            'occupation_id',
            'income',
            'bank_info',
            'company',
            'referrer_code'
        );
        $this->render();
        return redirect()->back();
    }


    public function render()
    {
        $this->cities = City::orderBy('name', 'asc')->orderBy('name', 'asc')->get();
        $this->districts = District::where('city_id', $this->city_id)->orderBy('name', 'asc')->get();
        $this->communes = Commune::where('district_id', $this->district_id)->orderBy('name', 'asc')->get();
        $this->villages = Village::where('commune_id', $this->commune_id)->orderBy('name', 'asc')->get();

        if (empty($this->referrer_code)) {
            return view('livewire.errors.401')->layout('layouts.frontend');
        } else {
            if (Agency::where('code', $this->referrer_code)->whereIn('status', [1, 2])->exists()) {
                return view('livewire.agency.register.agency-register')->layout('layouts.frontend')->title("Agency Registration");
            } else {
                return view('livewire.errors.404')->layout('layouts.frontend');
            }
        }
    }
    public function updated()
    {
        //--Calcualate age--
        if ($this->selectedYear) {
            $this->calculateAge();
        }
    }
    //--Calculate age by selected year--
    public function calculateAge()
    {
        $this->age = abs($this->selectedYear - date('Y'));
    }

    public $getDays = [];
    public $getMonth = [];
    public $getYears = [];

    public function mount()
    {
        for ($m = 1; $m <= 12; $m++) {
            $this->getMonth[] = date('F', mktime(0, 0, 0, $m, 1));
        }
        for ($day = 1; $day <= 31; $day++) {
            $this->getDays[] = $day;
        }
        for ($year = 1960; $year <= date('Y'); $year++) {
            $this->getYears[] = $year;
        }
        $this->occupations = Occupation::all();
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
    }
    public function switchLanguage($lang)
    {
        Session::put('locale', $lang);
        App::setLocale(session('locale'));
    }
}
