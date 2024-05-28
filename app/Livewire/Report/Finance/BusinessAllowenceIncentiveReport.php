<?php

namespace App\Livewire\Report\Finance;

use App\Exports\AllowenceIncentiveExport;
use App\Models\PayrollDetail;
use App\Services\DownloadPdfService;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class BusinessAllowenceIncentiveReport extends Component
{
    public $city_id;
    public $start_date, $end_date, $getCities, $getShops;
    public function render()
    {
        return view('livewire.report.finance.business-allowence-incentive-report', ['agencyIncentives' => $this->baiReport()])->layout('layouts.frontend')->title('Incentive Report');
    }
    public function baiReport()
    {
        $positionsToRetrieve = [1, 2, 3, 4];
        $query = PayrollDetail::whereHas('agency', function ($query) use ($positionsToRetrieve) {
            $query->whereIn('position_id', $positionsToRetrieve);
        })
            ->whereBetween('created_at', [$this->start_date . ' 00:00:00', $this->end_date . ' 23:59:59']);
        if ($this->city_id) {
            $query->whereHas('agency.address', function ($query) {
                $query->where('city_id', $this->city_id);
            });
        }
        $agencyIncentive = $query->get();
        return $agencyIncentive;
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
            'agencyIncentives' => $this->baiReport(),
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
        ];
        $pdf =  new DownloadPdfService('allowence-incentive-report.pdf', 'exports.pdf.allowence-incentive-report', $data);
        return $pdf->download();
    }
    public function download_excel()
    {
        $data = [
            'agencyIncentives' => $this->baiReport(),
        ];
        $fromStartDate = Carbon::parse($this->start_date)->format('d-m-Y');
        $toEndDate = Carbon::parse($this->end_date)->format('d-m-Y');
        $filename = 'allowence-incentive-report_' . $fromStartDate . '_' . $toEndDate . '.xlsx';
        return Excel::download(new AllowenceIncentiveExport($this->baiReport(), $this->start_date, $this->end_date), $filename);
    }
}
