<?php

namespace App\Livewire\Agency;

use App\Exports\ExportFileExcel;
use App\Imports\ImportFileExcel;
use App\Models\Address;
use App\Models\Agency;
use App\Models\AgencyHistory;
use App\Models\Occupation;
use App\Models\Position;
use App\Services\DownloadPdfService;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

class ImportFile extends Component
{
    use WithFileUploads;
    public $import_file;
    public $previewData = [];
    public $selectedRow = [];
    public $selectAll = [];
    public $code;
    public $positions, $occupations;
    public $cities, $districts, $communes, $villages, $city_id, $district_id, $commune_id, $village_id;
    public $checkbox_main = true;

    public function render()
    {
        return view('livewire.agency.import-file', ['previewData' => $this->previewData]);
    }
    //--import excel file---
    public function importFile()
    {
        $this->selectedRow = [];
        if ($this->import_file) {
            $file = $this->import_file;
            $this->previewData = Excel::toCollection(new ImportFileExcel, $file)->first()->toArray();
            $this->check_box_row(true);
        }
    }

    public function saveimportfile()
    {
        $get_selected_row = array_filter($this->selectedRow, function ($item) {
            return $item == true ? $item : null;
        });
        $get_selected_data_row = array_filter($this->previewData, function ($item) use ($get_selected_row) {
            if (in_array($item['id'], array_keys($get_selected_row))) {
                return $item;
            }
        });

        $get_code_exists = [];
        $get_success_recorded = [];
        $create_agency_history = new Create();
        foreach ($get_selected_data_row as $item) {
            if (!AgencyHistory::where('agency_code', $item['current_code'])->exists()) {
                if ($item['full_name'] != '' && $item['current_code'] != '') {
                    $leader = Agency::where('code', $item['current_leader_code'])->first();
                    $agency = Agency::where('id', $item['id'])->first();
                    if ($this->check_agency_history($item)) {
                        $agency = new Agency();
                        $agency->code = $item['current_code'] ?? null;
                        $agency->leader_code = $item['current_leader_code'] ?? null;
                        $agency->agency_id = $leader->id ?? null;
                        $agency->indirect_leader_code = $leader->parent->code ?? null;
                        $agency->indirect_leader_id = $leader->parent->id ?? null;
                        $agency->referrer_code = $item['referrer_code'] ?? null;
                        $agency->khmer_identity_card = $item['khmer_identity_card'] ?? null;
                        $agency->full_name = $item['full_name'] ?? null;
                        $agency->full_name_translate = $item['full_name_khmer'] ?? null;
                        $agency->phone = $item['phone'] ?? null;
                        $agency->phone_telegram = $item['phone_telegram'] ?? null;
                        $agency->gender = $item['gender'] ?? null;
                        $agency->age = $item['register_year'] ? date('Y') - $item['register_year'] : null;
                        $agency->position_id = $item['position_id'] ?? null;
                        $agency->occupation_id = $item['occupation_id'] ?? null;
                        $agency->income = $item['income'] ?? null;
                        $agency->status = $item['status'] ?? null;
                        $agency->bank_info = json_encode([['status' => true, 'name' => 'aba', 'account_number' => $item['bank_aba'], 'account_name' => $item['full_name']], ['status' => false, 'name' => 'acleda', 'account_number' => $item['bank_acleda'], 'account_name' => $item['full_name']]], JSON_UNESCAPED_UNICODE);
                        $agency->date_of_birth = json_encode(['day' => $item['birth_day'] ?? '', 'month' => $item['birth_month'] ?? '', 'year' => $item['birth_year'] ?? ''], JSON_UNESCAPED_UNICODE); // $item['date_of_birth'] ?? '';
                        $agency->remark = $item['remark'] ?? null;
                        $agency->created_by = Auth::user()->name;
                        $registered_date = $item['register_year'] . '-' . $item['register_month'] . "-" . $item['register_day'];
                        $agency->created_at = date('Y-m-d h:i:s', strtotime($registered_date));
                        if ($agency->save()) {
                            if (!empty($item['lc_code']) && $item['lc_code'] != '') {
                                $this->add_agency_history($agency, $item['lc_code'], 5, $item['lc_leader_code'], $registered_date);
                            }
                            if (!empty($item['ca_code']) && $item['ca_code'] != '') {
                                $this->add_agency_history($agency, $item['ca_code'], 4, $item['ca_leader_code'], $registered_date);
                            }
                            if (!empty($item['bm_code']) && $item['bm_code'] != '') {
                                $this->add_agency_history($agency, $item['bm_code'], 3, $item['bm_leader_code'], $registered_date);
                            }
                            if (!empty($item['bd_code']) && $item['bd_code'] != '') {
                                $this->add_agency_history($agency, $item['bd_code'], 2, $item['bd_leader_code'], $registered_date);
                            }

                            $create_agency_history->addCodeAgencyHistory($agency);
                            $address = new Address();
                            $address->agency_id = $agency->id ?? null;
                            $address->city_id = $item['city_id'] ?? null;
                            $address->district_id = $item['district_id'] ?? null;
                            $address->commune_id = $item['commune_id'] ?? null;
                            $address->village_id = $item['village_id'] ?? null;
                            $address->house_no = $item['house_no'] ?? null;
                            $address->street_no = $item['street_no'] ?? null;
                            $address->save();
                        }
                    }
                }
                $get_success_recorded[] = $item['current_code'];
            } else {
                $get_code_exists[] = $item['current_code'];
            }
        }
        return back()->with([
            'message' => '',
            'status' => 'success',
            'item_recorded' => $get_success_recorded,
            'item_exist' => $get_code_exists
        ]);
    }

    public function add_agency_history($agency, $agency_code, $position_id, $leader_code, $created_date)
    {
        if (AgencyHistory::where('agency_code', $agency_code)->exists()) {
            $agency_history = AgencyHistory::where('agency_code', $agency_code)->first();
            $add_agency_history = AgencyHistory::find($agency_history->id);
        } else {
            $add_agency_history = new AgencyHistory();
        }

        $add_agency_history->agency_id = $agency->id;
        $add_agency_history->agency_code = $agency_code;
        $add_agency_history->position_id = $position_id;

        if (AgencyHistory::where('agency_code', $leader_code)->exists()) {
            $agency_leader = AgencyHistory::where('agency_code', $leader_code)->first();
            $add_agency_history->leader_id = $agency_leader->agency_id ?? null;
        }
        $add_agency_history->leader_code = $leader_code;
        $add_agency_history->created_at = date('Y-m-d h:i:s', strtotime($created_date));
        $add_agency_history->save();
    }

    public function check_agency_history($item)
    {
        if (AgencyHistory::where('agency_code', $item['current_code'])->exists()) {
            $registered_date = $item['register_year'] . '-' . $item['register_month'] . "-" . $item['register_day'];
            AgencyHistory::where('agency_code', $item['current_code'])->firstOrNew([
                'created_at' => date('Y-m-d h:i:s', strtotime($registered_date))
            ]);
            return false;
        } else {
            return true;
        }
    }

    public function SelectAll()
    {
        $check_true = false;
        if ($this->checkbox_main)
            $check_true = true;

        $this->check_box_row($check_true);
    }

    public function check_box_row($check_true)
    {
        foreach ($this->previewData as $key => $item) {
            $this->selectedRow[$item['id']] = $check_true;
        }
    }

    public function downlaodExcelFile()
    {
        return Excel::download(new ExportFileExcel, 'sample_agency_data.xlsx', \Maatwebsite\Excel\Excel::XLSX);
    }
    //--download position--
    public function downloadPositions()
    {
        $this->positions = Position::all();
        $pdf = new DownloadPdfService('Position.pdf', 'exports.pdf.position', ['positions' => $this->positions]);
        return $pdf->download();
    }

    public function downloadOccupations()
    {
        $this->occupations = Occupation::orderBy('id', 'asc')->get();
        $pdf = new DownloadPdfService('Occupation.pdf', 'exports.pdf.occupation', ['occupations' => $this->occupations]);
        return $pdf->download();
    }

    public function downloadregion()
    {
        $this->redirect(route('agency.list', 'list?action=download'), navigate: true);
    }
}
