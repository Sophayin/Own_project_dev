<?php

namespace App\Exports;

use App\Models\Agency;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class RecruitReportByPositionExport implements FromView
{
    public $start_date, $end_date, $position_id, $city_id;
    public function __construct($start_date, $end_date, $position_id = null, $city_id = null)
    {
        $this->start_date = $start_date;
        $this->end_date = $end_date;
        $this->position_id = $position_id;
        $this->city_id = $city_id;
    }
    public function view(): View
    {
        $query_agency = Agency::whereBetween('created_at', [$this->start_date . ' 00:00:00 ', $this->end_date . ' 23:59:59 ']);
        if ($this->position_id) {
            $query_agency->where('position_id', $this->position_id);
        }
        if ($this->city_id) {
            $query_agency = Agency::whereHas('address', function ($query) {
                $query->where('city_id', $this->city_id);
            });
        }
        $agencies = $query_agency->get();
        return view('exports.recruit-report-by-position', ['start_date' => $this->start_date, 'end_date' => $this->end_date, 'agencies' => $agencies, 'position_id' => $this->position_id]);
    }
}
