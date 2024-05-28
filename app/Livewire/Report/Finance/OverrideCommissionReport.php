<?php

namespace App\Livewire\Report\Finance;

use App\Exports\OverrideCommissionReportExport;
use App\Models\Agency;
use App\Models\PayrollDetail;
use App\Models\Position;
use App\Services\DownloadPdfService;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class OverrideCommissionReport extends Component
{
    public $start_date, $end_date;
    public $getCities, $getShops;
    public $positionId;
    public $agenciesFilter, $cityId, $city_id;
    public $positions;

    public function render()
    {
        return view(
            'livewire.report.finance.override-commission-report',
            [
                'agencies' => $this->getPayrollDetail(),
            ]
        )->layout('layouts.frontend')->title('Override-commission-report');
    }
    public function getPayrollDetail()
    {
        $query = PayrollDetail::whereHas('agency', function ($query) {
            $query->when($this->positionId, function ($query) {
                $query->where('position_id', $this->positionId);
            });
        })
            ->whereBetween('created_at', [$this->start_date . ' 00:00:00 ', $this->end_date . ' 23:59:59 ']);
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
        $this->getShops = DB::table('shops')
            ->join('applications', 'shops.id', '=', 'applications.shop_id')
            ->select('shops.*', 'shop_id')
            ->distinct()
            ->get();

        $this->getCities = DB::table('cities')
            ->join('addresss', 'addresss.city_id', '=', 'cities.id')
            ->leftJoin('applications', 'applications.id', '=', 'addresss.application_id')
            ->whereNotNull('addresss.application_id')
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

        $pdf =  new DownloadPdfService('override-commission-report.pdf', 'exports.pdf.override-commission-report', $data);
        return $pdf->download();
    }

    public function download_excel()
    {
        $data = [
            'agenciesPayroll' => $this->getPayrollDetail(),
        ];
        $fromStartDate = Carbon::parse($this->start_date)->format('d-m-Y');
        $toEndDate = Carbon::parse($this->end_date)->format('d-m-Y');
        $filename = 'Override-commission-report_' . $fromStartDate . '_' . $toEndDate . '.xlsx';
        return Excel::download(new OverrideCommissionReportExport($this->getPayrollDetail(), $this->start_date, $this->end_date), $filename);
    }
}
