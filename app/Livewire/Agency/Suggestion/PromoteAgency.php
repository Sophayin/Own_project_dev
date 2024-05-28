<?php

namespace App\Livewire\Agency\Suggestion;

use App\Models\Agency;
use App\Models\AgencyHistory;
use App\Models\Position;
use App\Models\Promote;
use App\Models\Upload;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class PromoteAgency extends Component
{
    use WithFileUploads;
    public $position_id = 0, $agency_id, $agency_code, $agency_profile;
    public $current_leader_id, $current_leader_code;
    public $leader_id, $leader_code, $agency_leader_list = [];

    public $position_list = [];
    public $agency;
    public $city_id;
    public $district_id;
    public $commune_id;
    public $village_id;

    public $activeTab = 'information';
    public $new_agency_code;
    public $selectedAgencies = [];
    public $file_name, $file_id_card;
    public $documents, $previousRecord, $promoter_id;
    public $check_promote_code = false;
    public $update_position;
    public $recruitagencies;
    public $selectAll = false;
    public $agency_old_position_id;

    protected $rules = ([
        'position_id' => 'required',
        'agency_code' => 'required',
        'leader_id' => 'required'
    ]);
    public function messages()
    {
        return [
            'leader_id.required' => 'The leader field is required.',
            'position_id.required' => 'The position field is required.',
        ];
    }

    public function __construct()
    {
        $this->dispatch('loadLeaderSelected');
    }
    protected $listeners = ['render', 'leader_id'];

    public function leader_id()
    {
        return true;
    }


    public function mount()
    {
        $this->agency = Agency::find($this->agency_id);
        $this->current_leader_code = $this->agency->leader_code;
        $this->current_leader_id = $this->agency->agency_id;
        $this->agency_profile = $this->agency->agency_profile;
        $this->position_id = $this->agency->parent->position_id;

        //---Retrieve agency that under---
        //$this->recruitagencies = Agency::where('referrer_code', $this->agency->code)
        //    ->orWhere('agency_id', $this->agency->id)->get();

        $this->position_list = Position::where('id', '<', $this->agency->position_id)->orderBy('id', 'asc')->get();
        $this->documents = Upload::where('agency_id', $this->agency_id)->get();
    }

    public function render()
    {
        if ($this->position_id)
            $this->agency_leader_list = Agency::where('position_id', '<', $this->position_id)->get();

        return view('livewire.agency.suggestion.promote-agency', ['agency' => $this->agency, 'previousRecord' => $this->previousRecord])->title('Promote');
    }

    //public $iteration = 0;
    public function updated()
    {
        $this->dispatch('refreshDropdown');
        $check_position = AgencyHistory::where('agency_id', $this->agency_id)->where('position_id', '!=', 5)->where('position_id', $this->position_id)->first();
        if ($check_position) {
            $leader = Agency::find($check_position->leader_id);
            if ($leader && $leader->position_id < $this->position_id) {
                $this->agency_old_position_id = $check_position->id;
                $this->promoter_id = $this->current_leader_id;
                $this->leader_id = $check_position->leader_id;
                $this->agency_code = $check_position->agency_code;
                $this->leader_code = Agency::find($check_position->leader_id)->code;
                $this->check_promote_code = true;
            } else {
                $this->dispatch("alert.message", [
                    'type' => 'warning',
                    'message' => __("Currect leader not match")
                ]);
            }
        } else {
            $this->check_promote_code = false;
            $this->agency_code = generate_agency_code($this->position_id);
            if ($this->leader_id)
                $this->leader_code = Agency::find($this->leader_id)->code;
        }
    }
    //--Promote Agency
    public function promote()
    {
        $this->validate();
        $agency = Agency::find($this->agency_id);
        if ($this->check_promote_code) {
            $update_position = AgencyHistory::find($this->agency_old_position_id);
            $update_position->agency_code = $this->agency_code;
            $update_position->leader_id = $this->leader_id;
            $update_position->position_id = $this->position_id;
            $update_position->promoter_id = $this->current_leader_id;
            $update_position->status = "Promote";
            $update_position->save();
        } else {
            $add_new_position = new AgencyHistory();
            $add_new_position->agency_id = $this->agency_id;
            $add_new_position->agency_code = $this->agency_code;
            $add_new_position->leader_id = $this->leader_id;
            $add_new_position->promoter_id = $this->current_leader_id;
            $add_new_position->position_id = $this->position_id;
            $add_new_position->status = "Promote";
            $add_new_position->save();
        }
        $agency->position_id = $this->position_id;
        $agency->leader_code = $this->leader_code;
        $agency->code = $this->agency_code;

        $agency->agency_id = $this->leader_id;
        $agency->save();

        $this->updateSelectedAgencies();
        $this->dispatch("alert.message", [
            'type' => 'success',
            'message' => __("Successfully Promote")
        ]);
        return redirect()->route('agency.list', 'list?action=promote');
    }

    //--select all children agencies
    public function selectAll()
    {
        if ($this->selectAll) {
            $this->selectedAgencies = Agency::pluck('id')->toArray();
        } else {
            $this->selectedAgencies = [];
        }
    }
    //---update agency id that under----
    public function updateSelectedAgencies()
    {
        $promoteAgency = Agency::find($this->agency_id);
        if ($this->selectAll) {
            foreach ($this->recruitagencies as $agency) {
                $agency->agency_id = $promoteAgency->id;
                $agency->leader_code = $this->agency_code;
                $agency->save();
            }
        } else {
            foreach ($this->selectedAgencies as $agencyId) {
                $agency = Agency::find($agencyId);
                if ($agency) {
                    $agency->agency_id = $promoteAgency->id;
                    $agency->leader_code = $this->agency_code;
                    $agency->save();
                }
            }
        }
        $this->selectedAgencies = [];
    }

    //---Upload document----
    public function uploadDocument()
    {
        if ($this->file_name) {
            $file = new Upload();
            $file->agency_id = $this->agency_id;
            $file->file_name = $this->file_name->storeAs('file', $this->file_name->getClientOriginalName());
            $file->size = $this->file_name->getSize();
            $file->type = $this->file_name->getClientOriginalExtension();
            $file->save();
        }
        if ($this->file_id_card) {
            $file = new Upload();
            $file->agency_id = $this->agency_id;
            $file->file_name = $this->file_id_card->storeAs('file', $this->file_id_card->getClientOriginalName());
            $file->size = $this->file_id_card->getSize();
            $file->type = $this->file_id_card->getClientOriginalExtension();
            $file->save();
        } else {
            $this->dispatch("alert.message", [
                'type' => 'warning',
                'message' => __("Attach File to upload")
            ]);
        }
        if ($this->file_name && $this->file_id_card) {
            $this->dispatch("alert.message", [
                'type' => 'success',
                'message' => __("Successfully uploaded")
            ]);
        }
    }
}
