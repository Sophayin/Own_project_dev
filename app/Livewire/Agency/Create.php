<?php

namespace App\Livewire\Agency;

use App\Models\Address;
use App\Models\Agency;
use App\Models\AgencyHistory;
use App\Models\City;
use App\Models\Commune;
use App\Models\District;
use App\Models\Occupation;
use App\Models\Position;
use App\Models\Village;
use Livewire\Component;

class Create extends Component
{
    public $position_id, $code, $profile, $khmer_identity_card, $full_name, $full_name_translate,
        $age, $phone, $phone_telegram, $gender = 'Male', $schedule_training, $account_name, $account_number,
        $remark, $bank_account, $income, $city_id, $status = 2, $referrer_code, $latitude, $longitude;

    public $agency_id, $leader_code,  $indirect_leader_code, $indirect_leader_id;
    public $agency_list = [];
    public $cities = [];
    public $districts = [];
    public $communes = [];
    public $villages = [];
    public $district_id;
    public $village_id;
    public $commune_id;
    public $city, $district, $commune, $village;
    public $house_no, $street_no;
    public $occupation_id;
    public $occupations = [];
    public $positions = [];
    public $bank = [];
    public $leader;
    public $agencies = [];
    public $agency_code;
    public $showBankInfo = false;
    public $month = 0;
    public $thatMonth = 0;
    public $year = 0;
    public $day = 0;
    public $currentYear;
    public $date_of_birth = [];
    public $selectedYear;
    public $agency_referrer;
    public $bank_info = [];
    public $khmer_identity_card_exist;
    public $selectedBank;
    public $invalidMessage;

    protected $rules = [
        'full_name' => 'required|string|min:2|max:255',
        'full_name_translate' => 'required|string|min:2|max:255',
        'phone' => 'required|string|min:6',
        'position_id' => 'required',
        'khmer_identity_card' => 'required|string|min:5',
        'occupation_id' => 'required',
        //'referrer_code' => 'required',
        'city_id' => 'required',
        'bank_info' => 'required',
        'phone_telegram' => 'required'
    ];
    public function messages()
    {
        return [
            'khmer_identity_card.required' => 'The khmer identity card field is required.',
            'position_id.required' => 'The position field is required.',
            'occupation_id.required' => 'The occupation field is required.',
            'full_name_translate.required' => 'The agency name (Khmer) field is required.',
            'full_name.required' => 'The agency name (English) field is required.',
            'city_id.required' => 'The address field is required.',
            'phone_telegram.required' => 'The telegram field is required.'
        ];
    }

    // Referrer & leader of agency
    public function updated()
    {
        $this->chooseNewAgencyLeader();
        //--Calcualate age--
        if ($this->selectedYear) {
            $this->calculateAge();
        }
    }

    public function submit()
    {
        //if ($this->position_id == 5) {
        //    $valued = array_merge($this->rules, ['referrer_code' => 'required']);
        //    $this->validate($valued);
        //}
        $this->validate();
        $errors = $this->getErrorBag();

        if (Agency::where('khmer_identity_card', $this->khmer_identity_card)->exists()) {
            $errors->add('khmer_identity_card', 'The khmer identity card already used');
        }
        if (!empty($this->referrer_code) && !Agency::where('code', $this->referrer_code)->exists()) {
            $errors->add('referrer_code', 'The referrer code is invalid');
        }

        if (Agency::where('code', $this->code)->exists()) {
            $errors->add('code', 'The agency code is already exists');
        }
        if (count($errors)) {
            return $errors;
        }
        $this->resetErrorBag();

        $agency = new Agency;
        $agency->agency_profile = null;
        $agency->position_id = $this->position_id;
        $agency->khmer_identity_card = $this->khmer_identity_card;
        $agency->full_name = $this->full_name;
        $agency->full_name_translate = $this->full_name_translate;
        $agency->age = $this->age;
        $agency->phone = $this->phone;
        $agency->phone_telegram = $this->phone_telegram;
        $agency->income = $this->income;
        $agency->gender = $this->gender;
        $agency->code = $this->code;
        $agency->agency_id = $this->agency_id;
        $agency->leader_code = $this->leader_code;
        $agency->referrer_code = $this->referrer_code;
        $agency->indirect_leader_id = $this->indirect_leader_id;
        $agency->indirect_leader_code = $this->indirect_leader_code;
        $agency->schedule_training = $this->schedule_training;
        $agency->remark = $this->remark;
        $agency->occupation_id = $this->occupation_id;
        $agency->bank_info = json_encode($this->bank_info);
        $agency->date_of_birth = json_encode($this->date_of_birth);
        $agency->status = $this->status;
        $agency->created_by = Auth()->user()->username;
        $agency->created_at = $this->registration_date . ' ' . date("h:i:s");
        if ($agency->save()) {
            $this->addCodeAgencyHistory($agency);
            $address = new Address;
            $address->city_id = $this->city_id;
            $address->district_id = $this->district_id;
            $address->commune_id = $this->commune_id;
            $address->village_id = $this->village_id;
            $address->house_no = $this->house_no;
            $address->street_no = $this->street_no;
            $address->latitude = $this->latitude;
            $address->longitude = $this->longitude;
            $address->agency_id = $agency->id;
            $address->save();
        }
        create_transaction_log(__('Created agency') . ' : ' . $this->full_name, 'Created', __('This user created agency') . ' ' . $this->full_name . __('successfully') . ' ', $this->full_name);
        $this->dispatch('alert.message', [
            'type' => 'success',
            'message' => __("Agency successfully created")
        ]);
        $this->resetExcept('registration_date');
        $this->reset();
        $this->dispatch('refresh_agency');
    }

    public function addCodeAgencyHistory($agency)
    {
        $agency_history = new AgencyHistory();
        $agency_history->agency_id = $agency->id;
        $agency_history->agency_code = $agency->code;
        $agency_history->position_id = $agency->position_id;
        $agency_history->leader_id = $agency->agency_id;
        $agency_history->created_at = $this->registration_date . ' ' . date("h:i:s");
        $agency_history->save();
    }

    public function generateNewCode()
    {
        if ($this->position_id) {
            $this->code = generate_agency_code($this->position_id);
        }
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
        $this->cities = City::orderBy('name', 'asc')->orderBy('name', 'asc')->get();
        $this->districts = District::where('city_id', $this->city_id)->orderBy('name', 'asc')->get();
        $this->communes = Commune::where('district_id', $this->district_id)->orderBy('name', 'asc')->get();
        $this->villages = Village::where('commune_id', $this->commune_id)->orderBy('name', 'asc')->get();
    }

    //--Find Agency Leader By Referrer_code--
    public function findAgencyLeaderByreferrer()
    {
        $agency_referrer = Agency::where('code', $this->referrer_code)->first();
        if ($agency_referrer) {
            $this->agency_id = $agency_referrer->id;
            if ($agency_referrer->agency_id) {
                $this->agency_id = $agency_referrer->agency_id;
            }

            if ($agency_referrer->parent) {
                $this->leader_code = $agency_referrer->parent->code;
                $this->leader = $agency_referrer->parent->parent;
                $this->indirect_leader_id = $agency_referrer->parent->agency_id;
                $this->indirect_leader_code = $agency_referrer->parent->leader_code;
            } else {
                $this->agency_id = null;
                $this->leader_code = null;
                $this->leader = null;
                $this->indirect_leader_id = null;
                $this->indirect_leader_code = null;
            }
        } else {
            $this->agency_id = null;
            $this->leader_code = null;
            $this->leader = null;
            $this->indirect_leader_id = null;
            $this->indirect_leader_code = null;
        }
    }
    //--choose new agency leader--
    public function chooseNewAgencyLeader()
    {
        $agency = Agency::find($this->agency_id);
        if ($agency) {
            $this->leader = $agency->parent;
            $this->leader_code = $agency->code;
            $this->indirect_leader_id = $agency->parent->agency_id;
            $this->indirect_leader_code = $agency->parent->leader_code;
        } else {
            $this->leader_code = null;
            $this->leader = null;
            $this->indirect_leader_id = null;
            $this->indirect_leader_code = null;
        }
    }

    //--Bank info popup & save--
    public $bank_item = [];
    public function bankModal()
    {
        if ($this->bank_info) {
            $this->bank_item = $this->bank_info;
        } else {
            $this->bank_item = [[
                'status' => true,
                'name' => 'ACLEDA',
                'account_number' => '',
                'account_name' => ''
            ], [
                'status' => '',
                'name' => 'ABA',
                'account_number' => '',
                'account_name' => ''
            ]];
        }
        $this->dispatch('modal.bankModal');
    }

    public function saveBankInfo()
    {
        $this->bank_info = $this->bank_item;
    }
    public function addBank()
    {
        $this->bank_item[] = [
            'status' => '',
            'name' => '',
            'account_number' => '',
            'account_name' => ''
        ];
    }
    //--select only one bank---
    public function selectBank($key)
    {
        foreach ($this->bank_item as $index => $item) {
            if ($index == $key) {
                $this->bank_item[$index]['status'] = true;
            } else {
                $this->bank_item[$index]['status'] = false;
            }
        }
    }
    //--check by khmer id card if agency already exist, it alerts --
    public function checkIdCard()
    {
        $khmer_identity_card_exist = Agency::where('khmer_identity_card', $this->khmer_identity_card)->exists();
        if ($khmer_identity_card_exist) {
            $this->dispatch('alert.message', [
                'type' => 'warning',
                'message' => __('This agency already exists.')
            ]);
            return;
        }
    }

    //--Clear Bankinfo--
    public function clearBanInfo()
    {
        $this->bank_info = [];
    }

    //--Pop up address & save--
    public function addressModal()
    {
        $this->dispatch('modal.addressModal');
    }
    public function saveAddress()
    {
        $this->validate([
            'city_id' => ' required',
            'district_id' => 'required',
            'commune_id' => 'required',
            'village_id' => 'required'
        ]);
        $this->city = City::find($this->city_id);
        $this->district = District::find($this->district_id);
        $this->commune = Commune::find($this->commune_id);
        $this->village = Village::find($this->village_id);
    }
    //--clear address--
    public function clearAddress()
    {
        $this->city = "";
        $this->district = "";
        $this->commune = "";
        $this->village = "";
        $this->house_no = "";
        $this->street_no = "";
    }

    public $getMonth = [], $getDays = [], $getYears = [];
    public $registration_date;
    public function mount()
    {
        $this->registration_date = date('Y-m-d');
        $this->position_id = 5;
    }

    //--Calculate age by selected year--
    public function calculateAge()
    {
        $this->age = abs($this->selectedYear - date('Y'));
    }

    public function __construct()
    {
        $this->getMonth = [];
        for ($month = 1; $month <= 12; $month++) {
            $this->getMonth[] = date('F', mktime(0, 0, 0, $month, 1));
        }
        $this->getDays = [];
        for ($day = 1; $day <= 31; $day++) {
            $this->getDays[] = $day;
        }
        $this->getYears = [];

        for ($year = 1960; $year <= date("Y", strtotime("-10 year", time())); $year++) {
            $this->getYears[] = $year;
        }
        $this->dispatch('findAgencyLeader');
        $this->positions = Position::all();
        $this->occupations = Occupation::all();
        $this->cities = City::orderBy('name', 'asc')->orderBy('name', 'asc')->get();
        $this->districts = District::where('city_id', $this->city_id)->orderBy('name', 'asc')->get();
        $this->communes = Commune::where('district_id', $this->district_id)->orderBy('name', 'asc')->get();
        $this->villages = Village::where('commune_id', $this->commune_id)->orderBy('name', 'asc')->get();
        $this->agency_list = Agency::whereIn('position_id', get_agency_leader_by_position($this->position_id))
            ->whereNotNull('code')
            ->orderBy('code', 'ASC')
            ->get();
    }
    public function render()
    {
        return view('livewire.agency.create')->title("Create Agency");
    }
}
