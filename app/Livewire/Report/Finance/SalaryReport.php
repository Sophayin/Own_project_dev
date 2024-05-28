<?php

namespace App\Livewire\Report\Finance;

use App\Exports\SalaryReportExport;
use App\Exports\SalaryReportPdfExport;
use App\Models\Agency;
use App\Models\PayrollDetail;
use App\Services\DownloadPdfService;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class SalaryReport extends Component
{
    public $start_date, $end_date;
    public $getShops, $getCities;
    public $agencySetting;
    public $agenciesFilter, $cityId;
    public $positionsToRetrieve;
    public $city_id;

    public function render()
    {

        return view(
            'livewire.report.finance.salary-report',
            [
                'agenciesPayroll' => $this->getSalaryReport(),
            ]
        )->layout('layouts.frontend')
            ->title('Salary Report');
    }

    public function getSalaryReport()
    {
        $positionsToRetrieve = [2, 3, 4];

        $query = PayrollDetail::whereHas('agency', function ($query) use ($positionsToRetrieve) {
            $query->whereIn('position_id', $positionsToRetrieve);
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
        $this->getShops = DB::table('shops')
            ->join('applications', 'shops.id', '=', 'applications.shop_id')
            ->select('shops.*', 'shop_id')
            ->distinct()
            ->get();

        $this->getCities = DB::table('cities')
            ->join('addresss', 'addresss.city_id', '=', 'cities.id')
            ->whereNotNull('addresss.agency_id')
            ->select("cities.*")
            ->groupBy('cities.id')
            ->get();
    }
    //===Download===
    public function download_pdf()
    {
        $data = [
            'agenciesPayroll' => $this->getSalaryReport(),
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
        ];

        $pdf =  new DownloadPdfService('salary-report.pdf', 'exports.pdf.salary-report', $data);
        return $pdf->download();

        // return Excel::download(new SalaryReportPdfExport, 'Salary-report' . Carbon::now() . '.pdf', \Maatwebsite\Excel\Excel::MPDF);

    }

    public function download_excel()
    {
        $fromStartDate = Carbon::parse($this->start_date)->format('d-m-Y');
        $toEndDate = Carbon::parse($this->end_date)->format('d-m-Y');
        $filename = 'Salary-report_' . $fromStartDate . '_' . $toEndDate . '.xlsx';
        return Excel::download(new SalaryReportExport($this->getSalaryReport(), $this->start_date, $this->end_date), $filename);
    }
}
