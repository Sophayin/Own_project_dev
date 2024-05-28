<?php

namespace App\Livewire\Agency;

use App\Models\Agency;
use App\Models\AgencyHistory;
use App\Models\Application;
use App\Models\Upload;
use Illuminate\Support\Facades\Request;
use Livewire\Component;

class AgencyViewProfile extends Component
{
    public $agency, $full_name, $date_of_birth;
    public $agency_id, $applications, $getApplications;
    public $activeTab = "history";
    public $agency_histories;
    public $positions, $position_id, $leader_id;
    public $agencymembers;
    public $address;
    public $documents;


    public function mount()
    {
        $this->agency = Agency::find($this->agency_id);;
        $this->applications = $this->agency->application ?? [];
        $this->date_of_birth = json_decode($this->agency->date_of_birth);

        $this->agencymembers = Agency::where('referrer_code', $this->agency->code)
            ->orWhere('agency_id', $this->agency->id)->get();

        $this->documents = Upload::where('agency_id', $this->agency_id)->get();
    }
    public function render()
    {
        if (Request::get("tab") && !empty(Request::get("tab"))) {
            $this->activeTab = Request::get("tab");
        }
        //$this->agency_histories = AgencyHistory::where('agency_id', $this->agency_id)->get();
        //$this->getApplications = Application::with('shop')->where('agency_id', $this->agency_id)->get();
        return view('livewire.agency.agency-view-profile', ['promotes' => $this->agency_histories])->title("View-Profile");
    }
}
