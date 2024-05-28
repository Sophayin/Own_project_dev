<?php

namespace App\Livewire\Report\Agency;

use App\Exports\DailySaleReportExport;
use App\Exports\DailySaleReportPDFExport;
use App\Models\Application;
use App\Models\City;
use App\Models\Shop;
use App\Services\DownloadPdfService;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class DailySaleReport extends Component
{
    public $address;
    public $start_date, $end_date;
    public $shops = [];
    public $cities = [];
    public $selected_shop;
    public $getShops;
    public $getCities;
    public $city_id, $shop_id;
    public $applications;
    public $selectedShop;
    public $filter_by_status, $status;

    public function getApplications()
    {
        $applications = Application::query();

        if ($this->selected_shop) {
            $applications = $applications->where('shop_id', $this->selected_shop);
        }

        if ($this->start_date && $this->end_date) {
            $applications = $applications->whereBetween('created_at', [
                $this->start_date . ' 00:00:00',
                $this->end_date . ' 23:59:59'
            ]);
        }
        if ($this->filter_by_status != null) {
            $applications = $applications->where('status', $this->filter_by_status);
        }

        if ($this->city_id) {
            $applications = $applications->whereHas('address', function ($query) {
                $query->where('city_id', $this->city_id);
            });
        }

        $this->applications = $applications->get();
    }
    public function render()
    {
        $this->getApplications();

        return view('livewire.report.agency.daily-sale-report', [
            'selected_shop' => $this->selected_shop,
            'filter_by_status' => $this->filter_by_status
        ])->layout('layouts.frontend')->title('Daily-Sale Report');
    }
    public function mount()
    {
        $this->start_date = now()->startOfMonth()->toDateString();
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
    }
    public function onFilterStatus($status)
    {
        $this->filter_by_status = $status;
        $this->render();
    }

    public function download_pdf()
    {
        $this->getApplications();
        $data = [
            'applications' => $this->applications,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'selected_shop' => $this->selected_shop,
            'city_id' => $this->city_id,
            'filter_by_status' => $this->filter_by_status,
        ];
        $pdf =  new DownloadPdfService('Daily-Sale-report.pdf', 'exports.pdf.daily-sale-report', $data);
        return $pdf->download();
    }
    public function download_excel()
    {
        $shop_id = $this->selected_shop;
        $city_id = $this->city_id;
        $status = $this->filter_by_status;

        $fromStartDate = Carbon::parse($this->start_date)->format('Y-m-d');
        $toEndDate = Carbon::parse($this->end_date)->format('Y-m-d');
        $filename = 'daily-sale-report_' . $fromStartDate . '_' . $toEndDate . '.xlsx';
        return Excel::download(new DailySaleReportExport($this->start_date, $this->end_date, $shop_id, $city_id, $status), $filename);
    }
}
