<?php

namespace App\Livewire\Agency;

use App\Models\Agency;
use App\Models\Position;
use App\Models\Promote;
use Carbon\Carbon;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class AgencyList extends Component
{
    use WithPagination;
    public $id;
    public $action, $filter_by_status;
    public $positions;
    public $start_date, $end_date;
    public $getCities;
    public $status;
    public $agency_leader;
    public $position_id, $agency_id, $code, $leader_code, $full_name, $referrerCode;
    public $search = '';
    public $selected_status;
    public $generatedNumber;
    public $Manage_partner, $Business_director, $Branch_manager, $Consultant_advisor, $Least_consultant;
    public $previous_position_id;
    public $filter_agency_position;
    public $city_id;
    public $agenciesFilter;
    protected $queryString = ['action', 'agency_id'];
    protected $listeners = ['refresh_agency' => 'render'];


    public function render()
    {
        $this->agency_leader = Agency::whereIn('position_id', get_agency_leader_by_position($this->position_id))->get();
        $agencies = Agency::query();
        if ($this->search) {
            $txtSearch = trim($this->search);
            $agencies = $agencies->when($txtSearch, function ($q) use ($txtSearch) {
                $q->where('code', 'ilike', '%' . $txtSearch . '%');
                $q->orWhere('full_name', 'ilike', '%' . $txtSearch . '%');
            });
        }
        if ($this->filter_by_status != '') {
            $agencies = $agencies->where('status', $this->filter_by_status);
        }
        if ($this->filter_agency_position != '') {
            $agencies = $agencies->where('position_id', $this->filter_agency_position);
        }
        if ($this->start_date && $this->end_date) {
            $agencies = $agencies->whereBetween('created_at', ["$this->start_date 00:00:00", "$this->end_date 23:59:59"]);
        }
        if ($this->city_id != "") {
            $agencies = $agencies->whereHas('address', function ($q) {
                $q->where('city_id', $this->city_id);
            });
        }
        $agencies = $agencies->orderBy('id', 'DESC')->paginate(15);
        return view('livewire.agency.agency-list', ['agencies' => $agencies])->title("Agencies List");
    }

    //  Filter City
    public function onFilterCity($agency_id)
    {
        $this->agency_id = $agency_id;
    }
    // Filter by Status
    public function onFilterStatus($status)
    {
        $this->filter_by_status = $status;
    }

    public function button_promote_agnecy()
    {
        if (in_array('Promote', session('user_permission')['Agency'])) {
            $this->redirect(route('agency.list', 'list?action=promote'), navigate: true);
        } else {
            $this->dispatch("alert.message", [
                'type' => 'warning',
                'message' => __("Access Denied! You don't have permission to access this function. Request access from your administrator")
            ]);
        }
    }

    public function buttun_assign_shop($_agency_id)
    {
        if (in_array('Assign Shop', session('user_permission')['Agency'])) {
            $this->dispatch('assign_shop', agencyId: $_agency_id);

            $this->dispatch('modal.openModal');
        } else {
            $this->dispatch("alert.message", [
                'type' => 'warning',
                'message' => __("Access Denied! You don't have permission to access this function. Request access from your administrator")
            ]);
        }
    }

    public function button_demote_agnecy()
    {
        if (in_array('Demote', session('user_permission')['Agency'])) {
            $this->redirect(route('agency.list', 'list?action=demote'), navigate: true);
        } else {
            $this->dispatch("alert.message", [
                'type' => 'warning',
                'message' => __("Access Denied! You don't have permission to access this function. Request access from your administrator")
            ]);
        }
    }
    public function add_new_agency()
    {
        if (in_array('Create Agency', session('user_permission')['Agency'])) {
            $this->redirect(route('agency.list', 'list?action=create'), navigate: true);
        } else {
            $this->dispatch("alert.message", [
                'type' => 'warning',
                'message' => __("Access Denied! You don't have permission to access this function. Request access from your administrator")
            ]);
        }
    }

    public function btn_edit_agency($agency_id)
    {
        if (in_array('Edit Agency', session('user_permission')['Agency'])) {
            $this->redirect(route('agency.list', 'list?action=update&agency_id=' . $agency_id), navigate: true);
        } else {
            $this->dispatch("alert.message", [
                'type' => 'warning',
                'message' => __("Access Denied! You don't have permission to access this function. Request access from your administrator")
            ]);
        }
    }

    public function btn_preview_agency($agency_id)
    {
        if (in_array('Preview Agency', session('user_permission')['Agency'])) {
            $this->redirect(route('agency.list', 'list?action=profile&agency_id=' . $agency_id), navigate: true);
        } else {
            $this->dispatch("alert.message", [
                'type' => 'warning',
                'message' => __("Access Denied! You don't have permission to access this function. Request access from your administrator")
            ]);
        }
    }
    public function import_file()
    {
        $this->redirect(route('agency.list', 'list?action=import'), navigate: true);
    }


    // Generate code & save
    public function update_Code_Agency($agenId)
    {
        $agency = Agency::find($agenId);
        $this->id = $agenId;
        $this->full_name = $agency->full_name;
        $this->position_id = $agency->position_id;
        $this->agency_id = $agency->agency_id;
        $this->code = $agency->code;
        $this->leader_code = $agency->parent->code ?? 0;
        $this->dispatch('modal.updateCode');
    }

    //Generate agency Code
    public function updateCode()
    {
        $agency = Agency::find($this->id);
        $agency->position_id = $this->position_id;
        $agency->agency_id = $this->agency_id;
        $agency->code = $this->code;
        $agency->leader_code = $this->leader_code;
        $agency->status = $this->status = 2;

        create_transaction_log(__('Generate Code') . ':' . $this->code, __('Generate Code'), __('This user generate code') . $this->code . __('for agency') . ':' . $this->full_name, $this->code);
        $this->dispatch('alert.message', [
            'type' => 'success',
            'message' => __('Agency Code has been generated'),
        ]);
        $this->dispatch('modal.closeUpdateCode');
    }

    public function mount()
    {
        $this->start_date = Carbon::now()->startOfMonth()->toDateString();
        $this->end_date = today()->toDateString();
        $this->positions = Position::whereHas('agency')->orderby('id', 'asc')->get();
        $this->getCities = DB::table('cities')
            ->join('addresss', function (JoinClause $join) {
                $join->on('cities.id', '=', 'addresss.city_id');
            })
            ->join('agencies', function (JoinClause $join) {
                $join->on('addresss.agency_id', '=', 'agencies.id');
            })
            ->whereNotNull('addresss.agency_id')
            ->select("cities.*")
            ->groupBy('cities.id')
            ->get();
    }
    // update status & save
    public function update_status_agency($agencyId)
    {
        $agency = Agency::find($agencyId);
        $this->agency_id = $agencyId;
        $this->status = $agency->status;
        $this->dispatch('modal.updateStatus');
    }
    public function updateStatus()
    {
        $agency = Agency::find($this->agency_id);
        $agency->status = $this->status;
        $agency->save();

        create_transaction_log('Update status', 'Update', 'This user update status of agency successfully', $this->code);
        $this->dispatch('alert.message', [
            'type' => 'success',
            'message' => __('Status has been updated!'),
        ]);
    }
    //--Generate new agenc code---
    public function updated()
    {
        $this->generateNewCode();
    }
    public function generateNewCode()
    {
        if ($this->position_id) {
            $this->code = generate_agency_code($this->position_id);
        }
    }

    //--add data into agency_history table
    //public function addCodeInAgencyHistory()
    //{
    //    $agency = new Promote();
    //    $agency->agency_id = $this->id;
    //    $agency->agency_code = $this->code;
    //    $agency->position_id = $this->position_id;
    //    $agency->leader_id = $this->agency_id;
    //    $agency->status = "";
    //    $agency->save();
    //}
}
