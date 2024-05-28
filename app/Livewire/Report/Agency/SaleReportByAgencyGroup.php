<?php

namespace App\Livewire\Report\Agency;

use App\Exports\SaleReportAgencyGroupExport;
use App\Models\Agency;
use App\Services\DownloadPdfService;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class SaleReportByAgencyGroup extends Component
{
    public $address;
    public $start, $end, $start_date, $end_date;
    public $shops = [];
    public $cities = [];
    public $selected_shop;
    public $getShops;
    public $getCities;
    public $full_name;
    public $agency_id;
    public $agenId;
    public $totalApplications;
    public $city_id  = 0;
    public $agencyCount;
    public $sale_applications;
    public $recruit_agency;
    public $date, $agency, $firstMonthdata;
    public $agencies;
    public function render()
    {
        $this->agencies = DB::table("agencies as agency")
            ->whereBetween('created_at', [$this->start_date . ' 00:00:00 ', $this->end_date . ' 23:59:59 '])
            ->whereIn('agency.status', [1, 2])
            ->whereNull("agency_id")
            //->where('position_id', '!=', 5)
            ->select(
                'agency.id',
                'agency.position_id',
                'agency.code',
                'agency.full_name',
                'agency.agency_id',
                DB::raw("(WITH RECURSIVE cte AS (
                    SELECT id, code, referrer_code FROM agencies WHERE code = agency.code
                    UNION SELECT a.id,a.code, a.referrer_code FROM agencies a
                    JOIN cte ON cte.code = a.referrer_code)
                    SELECT COUNT(*) FROM cte
                        JOIN applications app ON app.agency_id = cte.id
                        JOIN addresss ON addresss.agency_id = cte.id
                        where app.status = 2 AND addresss.city_id = ' $this->city_id '
                        AND app.created_at BETWEEN '$this->start_date 00:00:00 ' AND '$this->end_date 23:59:59 ') as total_sale"),

                DB::raw("(WITH RECURSIVE cte AS (
                    SELECT id, agency_id,code,status FROM agencies WHERE code = agency.code
                    UNION SELECT a.id, a.agency_id,a.code,a.status FROM agencies a
                    JOIN cte ON cte.code = a.referrer_code )
                    SELECT COUNT(*) FROM cte
                        JOIN agencies b ON b.code = cte.code
                        JOIN agencies c ON c.referrer_code = cte.code AND c.status IN(1,2)
                        AND c.created_at BETWEEN '$this->start_date 00:00:00 ' AND '$this->end_date 23:59:59 ') as total_recruit")
            );

        if ($this->city_id) {
            $this->agencies = $this->agencies->whereHas('address', function ($query) {
                $query->where('city_id', $this->city_id);
            });
        }
        $this->agencies = $this->agencies->get();
        return view('livewire.report.agency.sale-report-by-agency-group', ['agencies' => $this->agencies])->layout('layouts.frontend')->title("Report Sale by Agency Group");
    }

    public function mount()
    {
        $td = Carbon::now();
        $this->start_date = $td->startOfMonth()->toDateString();
        $this->end_date = $td->endOfMonth()->toDateString();
    }
}
