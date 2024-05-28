<?php

namespace App\Livewire\Agency;

use App\Models\Address;
use App\Models\Agency;
use App\Models\AgencyHistory;
use App\Models\Application;
use App\Models\City;
use App\Models\Commune;
use App\Models\District;
use App\Models\Occupation;
use App\Models\Position;
use App\Models\Upload;
use App\Models\Village;
use Illuminate\Support\Facades\Request;
use Livewire\Component;
use Livewire\WithFileUploads;

class Update extends Component
{
    use WithFileUploads;
    public $position_id, $agency_id, $full_name, $code, $khmer_identity_card, $full_name_translate,
        $age, $phone, $phone_telegram, $occupation_id, $income, $gender, $remark, $city, $status,
        $agency_profile, $referrer_code, $latitude, $longitude, $file_name, $file_id_card, $documents,
        $birth_certificate, $leader_id;

    public $positions = [];
    public $agency = [];
    public $agencies;
    public $occupation = [];
    public $city_id;
    public $district_id;
    public $commune_id;
    public $village_id;
    public $cities = [];
    public $districts = [];
    public $communes = [];
    public $villages = [];
    public $leader;
    public $applications = [];
    public $activeTab = 'information';
    public $address, $house_no, $street_no;
    public $getApplications;
    //public $days, $months, $years;
    public $getMonth, $getDays, $getYears;
    public $bank_info = [];
    public $date_of_birth = [];
    public $docToDeleteId;
    public $agency_leader, $leader_code, $id, $origin_referrer_code;
    public $indirect_leader_id, $indirect_leader_code;
    public $selectedYear;
    public $invalidMessage;
    public $registration_date;

    protected $listeners = ['confirmDelete'];

    protected $rules = [
        'full_name' => 'required|string|min:2|max:255',
        'full_name_translate' => 'required|string|min:2|max:255',
        'phone' => 'required|string|min:6',
        'khmer_identity_card' => 'required|string|min:5|max:15',
        'occupation_id' => 'required',
        'code' => 'required'
    ];
    public function messages()
    {
        return [
            'khmer_identity_card.required' => 'The khmer identity card field is required.',
            'occupation_id.required' => 'The occupation field is required.',
            'full_name_translate.required' => 'The agency name (Khmer) field is required.',
            'full_name.required' => 'The agency name (English) field is required.',
        ];
    }
    public function render()
    {
        $this->dispatch('findAgencyLeader');
        if (empty($this->agency_id)) {
            return view('livewire.errors.404')->layout('layouts.frontend');
        }
        if (Request::get("tab") && !empty(Request::get("tab"))) {
            $this->activeTab = Request::get("tab");
        }
        $this->agency_leader = Agency::whereIn('position_id', get_agency_leader_by_position(5))
            ->whereNotNull('code')
            ->orderBy('code', 'ASC')
            ->get();
        $this->occupation = Occupation::all();
        $this->positions = Position::all();
        $this->cities = City::orderBy('name', 'asc')->orderBy('name', 'asc')->get();
        $this->districts = District::where('city_id', $this->city_id)->orderBy('name', 'asc')->get();
        $this->communes = Commune::where('district_id', $this->district_id)->orderBy('name', 'asc')->get();
        $this->villages = Village::where('commune_id', $this->commune_id)->orderBy('name', 'asc')->get();
        $this->agencies = Agency::whereNotIn("position_id", [5])->get();
        return view('livewire.agency.update');
    }
    public function __construct()
    {
        for ($month = 1; $month <= 12; $month++) {
            $this->getMonth[] = date('F', mktime(0, 0, 0, $month, 1));
        }
        for ($day = 1; $day <= 31; $day++) {
            $this->getDays[] = $day;
        }
        for ($year = 1960; $year <= date("Y", strtotime("-10 year", time())); $year++) {
            $this->getYears[] = $year;
        }
    }
    public function mount()
    {
        if (!empty($this->agency_id)) {


            $agency = Agency::find($this->agency_id);
            $this->applications = $agency->applications;
            $this->agency = $agency;
            $this->code = $agency->code;
            $this->registration_date = $agency->created_at->format("Y-m-d");
            $this->applications = $agency->application ?? [];
            $this->position_id = $agency->position_id;
            $this->khmer_identity_card = $agency->khmer_identity_card;
            $this->full_name = $agency->full_name;
            $this->full_name_translate = $agency->full_name_translate;
            $this->age = $agency->age;
            $this->phone = $agency->phone;
            $this->phone_telegram = $agency->phone_telegram;
            $this->occupation_id = $agency->occupation_id;
            $this->leader_id = $agency->agency_id;
            $this->leader_code = $agency->leader_code;
            $this->indirect_leader_id = $agency->indirect_leader_id;
            $this->indirect_leader_code = $agency->indirect_leader_code;

            $this->origin_referrer_code = $agency->referrer_code;
            $this->income = $agency->income;
            $this->gender = $agency->gender;
            $this->bank_info = json_decode($agency->bank_info, true);
            $this->bank_item = json_decode($agency->bank_info, true);

            $this->date_of_birth = json_decode($agency->date_of_birth);
            $this->remark = $this->agency->remark;
            if ($agency->address) {
                $this->address = Address::find($agency->address->id);
                $this->city_id = $agency->address->city_id;
                $this->district_id = $agency->address->district_id;
                $this->commune_id = $agency->address->commune_id;
                $this->village_id = $agency->address->village_id;
                $this->house_no = $agency->address->house_no;
                $this->street_no = $agency->address->street_no;
                $this->latitude = $agency->address->latitude;
                $this->longitude = $agency->address->longitude;
            }
            if ($agency->agency_id) {
                $this->leader = $agency->parent;
            }
            $this->documents = Upload::where('agency_id', $this->agency_id)->get();
        }
    }

    public function update()
    {
        $this->validate();
        $agency = Agency::find($this->agency_id);
        if ($agency->referrer_code !== $this->origin_referrer_code) {
            $this->validate([
                'file_name' => 'required',
            ]);
        }
        if (AgencyHistory::where('agency_code', $this->code)->where('id', '!=', $this->agency_id ?? null)->exists()) {
            return $this->dispatch('alert.message', [
                'type' => 'warning',
                'message' => __('The agency code is already exists')
            ]);
        }
        $agency->full_name = $this->full_name;
        $agency->agency_profile = $this->agency_profile != null ? $this->agency_profile->store('photos') : $agency->agency_profile;
        $agency->khmer_identity_card = $this->khmer_identity_card;
        $agency->full_name = $this->full_name;
        $agency->full_name_translate = $this->full_name_translate;
        $agency->age = $this->age;
        $agency->code = $this->code;
        $agency->phone = $this->phone;
        $agency->phone_telegram = $this->phone_telegram;
        $agency->occupation_id = $this->occupation_id;
        $agency->income = $this->income;
        $agency->gender = $this->gender;
        $agency->referrer_code = $this->origin_referrer_code;
        $agency->agency_id = $this->leader_id;
        $agency->leader_code = $this->leader_code;
        $agency->indirect_leader_id = $this->indirect_leader_id;
        $agency->indirect_leader_code = $this->indirect_leader_code;

        $agency->bank_info = json_encode($this->bank_info);
        $agency->date_of_birth = json_encode($this->date_of_birth);
        $agency->remark = $this->remark;
        $agency->updated_by = Auth()->user()->username;
        $agency->created_at = $this->registration_date . ' ' . date("h:i:s");

        if ($agency->save()) {
            if ($agency->address) {
                $address = Address::find($agency->address->id);
                $address->city_id = $this->city_id;
                $address->district_id = $this->district_id;
                $address->commune_id = $this->commune_id;
                $address->village_id = $this->village_id;
                $address->house_no = $this->house_no;
                $address->street_no = $this->street_no;
                $address->latitude = $this->latitude;
                $address->longitude = $this->longitude;
                $address->save();
            } else {
                $address = new Address;
                $address->city_id = $this->city_id;
                $address->district_id = $this->district_id;
                $address->commune_id = $this->commune_id;
                $address->village_id = $this->village_id;
                $address->house_no = $this->house_no;
                $address->street_no = $this->street_no;
                $address->latitude = $this->latitude;
                $address->longitude = $this->longitude;
                $address->agency_id = $agency['id'];
                $address->save();
            }
        }
        $this->uploadDocument();

        create_transaction_log(__('Updated agency') . ' : ' . $this->full_name, 'Updated', __('This user updated agency') . ' ' . $this->full_name . __('successfully') . ' ', $this->full_name);
        $this->dispatch("alert.message", [
            'type' => 'success',
            'message' => __("Agency successfully updated")
        ]);
        $this->dispatch('refresh_agency');
    }

    public function updated()
    {
        if ($this->selectedYear) {
            $this->calculateAge();
        }
        $this->chooseNewAgencyLeader();
    }
    //--Find Agency Leader By Referrer_code--
    public function findAgencyLeaderByreferrer()
    {
        $agency_referrer = Agency::where('code', $this->origin_referrer_code)->first();
        if ($agency_referrer) {
            $this->leader_id = $agency_referrer->id;
            if ($agency_referrer->agency_id) {
                $this->leader_id = $agency_referrer->agency_id;
            }

            if ($agency_referrer->parent) {
                $this->leader_code = $agency_referrer->leader_code;
                $this->indirect_leader_id = $agency_referrer->parent->agency_id;
                $this->indirect_leader_code = $agency_referrer->parent->leader_code;
            } else {
                $this->leader_id = null;
                $this->leader_code = null;
                $this->indirect_leader_id = null;
                $this->indirect_leader_code = null;
            }
        } else {
            $this->leader_id = null;
            $this->leader_code = null;
            $this->indirect_leader_id = null;
            $this->indirect_leader_code = null;
        }
    }

    //--choose new agency leader--
    public function chooseNewAgencyLeader()
    {
        if ($this->leader_id) {
            $agency = Agency::find($this->leader_id);
            $this->leader_code = $agency->leader_code;
            if ($agency->parent) {
                $this->indirect_leader_id = $agency->parent->id;
                $this->indirect_leader_code = $agency->parent->code;
            } else {
                $this->leader_code = null;
                $this->leader = null;
                $this->indirect_leader_id = null;
                $this->indirect_leader_code = null;
            }
        }
    }

    //--Calculate age by selected year--
    public function calculateAge()
    {
        $this->age = abs($this->selectedYear - date('Y'));
    }

    public function onChange($type, $value)
    {
        if ($type == 'city') {
            $this->city_id = $value;
            $this->district_id = 0;
            $this->commune_id = 0;
        } elseif ($type == 'district') {
            $this->district_id = $value;
            $this->commune_id = $value;
        } elseif ($type == 'commune') {
            $this->commune_id = $value;
        }
    }

    // Popup & add Bank Info
    public $bank_item = [];
    public function bankModal()
    {
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
    public function selectBank($key)
    {
        foreach ($this->bank_item as $index => $item) {
            if ($index == $key) {
                $this->bank_item[$index]['status'] = true;
            } else {
                if (isset($this->bank_item[$index]['status'])) {
                    $this->bank_item[$index]['status'] = false;
                }
            }
        }
    }

    // Clear Bankinfo
    public function clearBanInfo()
    {
        $this->bank_info = [];
    }
    public function uploadDoc()
    {
        $this->dispatch('modal.openModal');
    }
    public function uploadDocument()
    {
        if ($this->file_name || $this->birth_certificate || $this->file_id_card) {
            if ($this->file_name) {
                $file = new Upload();
                $file->agency_id = $this->agency_id;
                $file->file_name = $this->file_name->storeAs('file', $this->file_name->getClientOriginalName());
                $file->size = $this->file_name->getSize();
                $file->type = $this->file_name->getClientOriginalExtension();
                $file->save();
                $this->dispatch("alert.message", [
                    'type' => 'success',
                    'message' => __("Successfully uploaded")
                ]);
            }
            if ($this->birth_certificate) {
                $file = new Upload();
                $file->agency_id = $this->agency_id;
                $file->file_name = $this->birth_certificate->storeAs('file', $this->birth_certificate->getClientOriginalName());
                $file->size = $this->birth_certificate->getSize();
                $file->type = $this->birth_certificate->getClientOriginalExtension();
                $file->save();
                $this->dispatch("alert.message", [
                    'type' => 'success',
                    'message' => __("Successfully uploaded")
                ]);
            }
            if ($this->file_id_card) {
                $file = new Upload();
                $file->agency_id = $this->agency_id;
                $file->file_name = $this->file_id_card->storeAs('file', $this->file_id_card->getClientOriginalName());
                $file->size = $this->file_id_card->getSize();
                $file->type = $this->file_id_card->getClientOriginalExtension();
                $file->save();
                $this->dispatch("alert.message", [
                    'type' => 'success',
                    'message' => __("Successfully uploaded")
                ]);
            }
        } else {
            $this->dispatch("alert.message", [
                'type' => 'warning',
                'message' => __("Attach File to upload")
            ]);
        }
    }
    public function deleteDoc($docId)
    {
        $this->docToDeleteId = $docId;
        $this->dispatch('modal.confirmDelete');
    }
    public function confirmDelete()
    {
        if ($this->docToDeleteId) {
            $document = Upload::findOrFail($this->docToDeleteId);
            $document->delete();
            $this->documents = Upload::where('agency_id', $this->agency_id)->get();
            $this->dispatch('modal.closeDelete');
            $this->dispatch('alert.message', [
                'type' => 'success',
                'message' => __("Deleted Successfully")
            ]);
        }
    }
}
