<?php

namespace App\Livewire\Agency\Suggestion;

use App\Models\Agency;
use App\Models\AgencyHistory;
use App\Models\Position;
use App\Models\Upload;

use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class Demote extends Component
{
    use WithFileUploads;
    public $position_id, $agency_id, $agency_code, $agency_profile;

    public $position_list = [];
    public $agency;
    public $city_id;
    public $district_id;
    public $commune_id;
    public $village_id;

    public $new_agency_code;
    public $selectedAgencies = [];
    public $file_name, $file_id_card;
    public $documents, $previousRecord, $promoter_id;
    public $check_promote_code;

    public $update_position;
    public $promoteAgency;
    public $leader_id, $leader_code, $current_leader_code, $current_leader_id, $agency_leader_list = [];
    public $status;

    protected $rules = ([
        'position_id' => 'required',
        'agency_code' => 'required',
        'leader_id' => 'required'
    ]);
    public function messages()
    {
        return [
            'position_id.required' => 'The position field is required.',
            'leader_id.required' => 'The leader field is required.',
        ];
    }
    public function mount()
    {
        $this->agency = Agency::find($this->agency_id);
        $this->current_leader_code = $this->agency->leader_code ?? $this->current_leader_code = $this->agency->parent->code ?? '';
        $this->current_leader_id = $this->agency->agency_id;
        $this->agency_profile = $this->agency->agency_profile;
        $this->position_id = $this->agency->position_id ?? null;
        if ($this->position_id) {
            $this->position_list = Position::where('id', '>', $this->position_id)->orderBy('id', 'asc')->get();
        }
        $this->documents = Upload::where('agency_id', $this->agency_id)->get();
    }

    public function updated()
    {
        if ($this->position_id) {
            $check_position = AgencyHistory::where('agency_id', $this->agency_id)->where('position_id', $this->position_id)->first();
            if ($check_position) {
                $this->leader_id = $check_position->leader_id;
                $this->agency_code = $check_position->agency_code;
                $this->check_promote_code = true;
            } else {
                $this->check_promote_code = false;
                if ($this->leader_id && $this->position_id) {
                    $this->agency_code = generate_agency_code($this->position_id);
                }
            }
        }
    }
    //--Demote Agency
    public function submit_demote()
    {
        $this->updateSelectedAgencies();
        $this->validate();
        $agency = Agency::find($this->agency->id);
        if ($this->check_promote_code) {
            $update_position = AgencyHistory::where('agency_id', $this->agency_id)->first();
            if ($this->update_position) {
                $update_position->agency_code = $this->agency_code;
                $update_position->leader_id = $this->leader_id;
                $update_position->position_id = $this->position_id;
                $update_position->promoter_id = $this->current_leader_id;
                $update_position->status = "Demote";
                $update_position->save();
            }
        } else {
            $add_new_position = new AgencyHistory();
            $add_new_position->agency_id = $this->agency_id;
            $add_new_position->agency_code = $this->agency_code;
            $add_new_position->leader_id = $this->leader_id;
            $add_new_position->promoter_id = $this->current_leader_id;
            $add_new_position->position_id = $this->position_id;
            $add_new_position->status = "Demote";
            $add_new_position->save();
        }
        $agency->position_id = $this->position_id;
        $agency->leader_code = $this->leader_code;
        $agency->code = $this->agency_code;
        $agency->agency_id = $this->leader_id;
        $agency->save();
        $this->dispatch("alert.message", [
            'type' => 'success',
            'message' => __("Agency successfully updated")
        ]);
        //$this->redirect(url('agency/list?action=demote'), navigate: true);
    }

    public function render()
    {
        $this->dispatch('loadLeaderSelected');
        //---Retrieve agency that under---
        $recruitagencies = Agency::where('referrer_code', $this->agency->code)
            ->orWhere('agency_id', $this->agency->id)->get();

        //----retrieve leader by level----
        if ($this->position_id) {
            $this->agency_leader_list = Agency::where('position_id', '<',  $this->position_id)->whereNotIn('id', [$this->agency->id])->get();
        }
        return view('livewire.agency.suggestion.demote', ['recruitagencies' => $recruitagencies])->title('Demote');
    }
    //--select all children agencies
    public $selectAll = false;
    public function selectAll()
    {
        $this->selectedAgencies = Agency::pluck('id')->toArray();
    }
    //--change agency leader---
    public function updateSelectedAgencies()
    {
        if (empty($this->selectedAgencies)) {
            return;
        }
        foreach ($this->selectedAgencies as $agencyId) {
            $agency = Agency::find($agencyId);
            if ($agency) {
                $agency->agency_id = $this->current_leader_id;
                $agency->leader_code = $this->agency_code;
                $agency->save();
            }
        }
    }

    //---Upload document----
    public function upload_document()
    {
        $fileExtension = $this->file_name->getClientOriginalExtension();

        $file = new Upload();
        $file->agency_id = $this->agency_id;
        $file->file_name = $this->file_name != null ? $this->file_name->storeAs('file', $this->file_name->getClientOriginalName()) : $file->file_name;
        $fileSize = $this->file_name != null ? $this->file_name->getSize() : null;
        $file->size = $fileSize;
        $file->type = $fileExtension;
        $file->save();

        $file = new Upload();
        $file->agency_id = $this->agency_id;
        $file->file_name = $this->file_id_card != null ? $this->file_id_card->storeAs('file', $this->file_id_card->getClientOriginalName()) : $file->file_name;
        $fileSize = $this->file_name != null ? $this->file_name->getSize() : null;
        $file->size = $fileSize;
        $file->type = $fileExtension;
        $file->save();
        $this->dispatch("alert.message", [
            'type' => 'success',
            'message' => __("Successfully uploaded")
        ]);
    }
}
