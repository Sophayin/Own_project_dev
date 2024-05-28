<?php

namespace App\Exports;

use App\Models\Application;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class DailySaleReportPDFExport implements FromView
{
    public $apps, $selected_shop, $city_id, $status;
    public function __construct($applications, $selected_shop, $city_id, $status)
    {
        $this->apps = $applications;
        $this->selected_shop = $selected_shop;
        $this->city_id = $city_id;
        $this->status = $status;
    }
    public function view(): View
    {
        return view('exports.pdf.daily-sale-report', [
            'applications' => $this->apps,
            'selected_shop' => $this->selected_shop,
            'city_id' => $this->city_id,
            'status' => $this->status,
        ]);
    }
}
