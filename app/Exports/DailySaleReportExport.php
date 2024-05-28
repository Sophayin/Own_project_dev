<?php

namespace App\Exports;

use App\Models\Application;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\FromView;

class DailySaleReportExport implements FromView
{
    public $start_date, $end_date, $shop_id, $city_id, $status;
    public function __construct($start_date, $end_date, $shop_id = null, $city_id = null, $status)
    {
        $this->start_date = $start_date;
        $this->end_date = $end_date;
        $this->shop_id = $shop_id;
        $this->city_id = $city_id;
        $this->status = $status;
    }
    public function view(): View
    {
        $query_applications = Application::whereBetween('created_at', [$this->start_date . ' 00:00:00 ', $this->end_date . ' 23:59:59 ']);
        if ($this->shop_id) {
            $query_applications->where('shop_id', $this->shop_id);
        }
        if ($this->city_id) {
            $query_applications = Application::whereHas('address', function ($query) {
                $query->where('city_id', $this->city_id);
            });
        }
        if ($this->status) {
            $query_applications->where('status', $this->status);
        }
        $applications = $query_applications->get();
        return view('exports.daily-sale-report', ['start_date' => $this->start_date, 'end_date' => $this->end_date, 'applications' => $applications, 'selected_shop' => $this->shop_id, 'status' => $this->status]);
    }
}
