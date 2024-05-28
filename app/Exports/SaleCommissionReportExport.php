<?php

namespace App\Exports;

use App\Models\PayrollDetail;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class SaleCommissionReportExport implements FromView
{
    private $saleCommissionReports;
    public $start_date, $end_date;

    public function __construct($saleCommissionReports, $start_date, $end_date)
    {
        $this->start_date = $start_date;
        $this->end_date = $end_date;
        $this->saleCommissionReports = $saleCommissionReports;
    }

    public function view(): View
    {

        return view('exports.sale-commission-report', ['start_date' => $this->start_date, 'end_date' => $this->end_date, 'agenciesPayroll' => $this->saleCommissionReports]);
    }
}
