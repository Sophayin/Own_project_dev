<?php

namespace App\Livewire\Report\Agency;

use App\Exports\RecruitByPositionPdfExport;
use App\Exports\RecruitReportByPositionExport;
use App\Models\Agency;
use App\Models\Position;
use App\Services\DownloadPdfService;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class RecruitReportByAgencyPosition extends Component
{
    public $address;
    public $start, $end, $start_date, $end_date;
    public $shops = [];
    public $cities = [];
    public $selected_shop;
    public $getShops;
    public $getCities;
    public $city_id;
    public $agenciesFilter;
    public $positions;
    public $position_id;
    public $agencies;


    public function getAgency()
    {
        $agencies = Agency::orderBy('code', 'ASC');
        if ($this->start_date && $this->end_date) {
            $agencies = $agencies->whereBetween('created_at', [$this->start_date . ' 00:00:00 ', $this->end_date . ' 23:59:59 ']);
        }
        if ($this->position_id) {
            $agencies = $agencies->whereHas('position', function ($query) {
                $query->where('id', $this->position_id);
            });
        }
        if ($this->city_id) {
            $agencies = $agencies->whereHas('address', function ($query) {
                $query->where('city_id', $this->city_id);
            });
        }
        $this->agencies = $agencies->get();
    }
    public function render()
    {
        $this->getAgency();
        return view('livewire.report.agency.recruit-report-by-agency-position')->layout('layouts.frontend')->title('Recruit Report By Agency Position');
    }

    public function mount()
    {
        $this->start_date = now()->startOfMonth()->toDateString();
        $this->end_date = now()->endOfMonth()->toDateString();

        // GET ALL CITIES BY AGENCY ######
        $this->getCities = DB::table('cities')
            ->join('addresss', 'addresss.city_id', '=', 'cities.id')
            ->join('agencies', 'addresss.city_id', '=', 'agencies.id')
            ->whereNotNull('addresss.agency_id')
            ->select("cities.*")
            ->groupBy('cities.id')
            ->get();
        $this->positions = DB::table('positions')
            ->join('agencies', 'agencies.position_id', '=', 'positions.id')
            ->select('positions.*')
            ->groupBy('positions.id')
            ->get();
    }
    public function download_pdf()
    {
        $this->getAgency();
        $data = [
            'agencies' => $this->agencies,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'city_id' => $this->city_id,
            'position_id' => $this->position_id,
        ];

        $pdf =  new DownloadPdfService(__('Recruit Report By Agency Position'), 'exports.pdf.recruit-report-by-position', $data);
        return $pdf->download();
    }

    public function download_excel()
    {
        $position_id = $this->position_id;
        $city_id = $this->city_id;
        $fromStartDate = Carbon::parse($this->start_date)->format('Y-m-d');
        $toEndDate = Carbon::parse($this->end_date)->format('Y-m-d');
        $filename = 'recruit-by-position-report_' . $fromStartDate . '_' . $toEndDate . '.xlsx';
        return Excel::download(new RecruitReportByPositionExport($this->start_date, $this->end_date, $position_id, $city_id), $filename);
    }
}
