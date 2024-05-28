<?php

namespace App\Livewire\Report\Finance;

use App\Exports\OverwriteCommissionPdfExport;
use App\Exports\SaleCommissionReportExport;
use App\Exports\SaleCommissionReportPdfExport;
use App\Models\Agency;
use App\Models\PayrollDetail;
use App\Models\Position;
use App\Services\DownloadPdfService;
use Carbon\Carbon;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class SaleCommissionReport extends Component
{
    public $start_date, $end_date;
    public $getCities, $getShops;
    public $awards, $target_sale;
    public $positionId, $awardTarget, $positions;
    public $commission_fee, $agencySetting;
    public $referrer_code, $recruit_agency;
    public $agenciesFilter, $city_id;
    public $position_id;


    public function render()
    {
        // ===retrieve all lc===
        $agenciesPayroll = PayrollDetail::whereHas('agency', function ($query) {
            $query->whereIn('position_id', [2, 3, 4, 5]);
        });
        return view(
            'livewire.report.finance.sale-commission-report',
            [
                'agenciesPayroll' => $agenciesPayroll,
                'agenciesPayroll' => $this->getPayrollDetail()
            ]
        )->layout('layouts.frontend')->title('Sale Commission Report');
    }

    public function getPayrollDetail()
    {
        $query =  PayrollDetail::whereHas('agency', function ($query) {
            $query->when($this->positionId, function ($query) {
                $query->where('position_id', $this->positionId);
            });
        })
            ->whereBetween('created_at', [$this->start_date . ' 00:00:00', $this->end_date . ' 23:59:59']);
        if ($this->city_id) {
            $query->whereHas('agency.address', function ($query) {
                $query->where('city_id', $this->city_id);
            });
        }
        $payrollDetails = $query->get();
        return $payrollDetails;
    }

    public function mount()
    {
        $this->start_date = now()->startOfMOnth()->toDateString();
        $this->end_date = now()->endOfMonth()->toDateString();
        $this->getCities = DB::table('cities')
            ->join('addresss', 'addresss.city_id', '=', 'cities.id')
            ->leftJoin('payroll_details', 'payroll_details.id', '=', 'addresss.id')
            ->whereNotNull('addresss.agency_id')
            ->select("cities.*")
            ->groupBy('cities.id')
            ->get();

        $this->positions = DB::table('positions')
            ->join('agencies', 'positions.id', '=', 'agencies.position_id')
            ->join('payroll_details', 'agencies.id', '=', 'payroll_details.agency_id')
            ->select("positions.*")
            ->groupBy('positions.id')
            ->get();
    }
    //===Download===
    public function download_pdf()
    {

        $data = [
            'agenciesPayroll' => $this->getPayrollDetail(),
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
        ];

        $pdf =  new DownloadPdfService('sale-commission-report.pdf', 'exports.pdf.sale-commission', $data);
        return $pdf->download();
    }


    public function download_excel()
    {
        $fromStartDate = Carbon::parse($this->start_date)->format('d-m-Y');
        $toEndDate = Carbon::parse($this->end_date)->format('d-m-Y');
        $filename = 'sale-commission-report_' . $fromStartDate . '_' . $toEndDate . '.xlsx';
        return Excel::download(new SaleCommissionReportExport($this->getPayrollDetail(), $this->start_date, $this->end_date), $filename);
    }
}
