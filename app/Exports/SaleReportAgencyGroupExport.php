<?php

namespace App\Exports;

use App\Models\Agency;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class SaleReportAgencyGroupExport implements FromView
{
    public $agencies;
    public function __construct($agencies)
    {
        $this->agencies = $agencies;
    }

    public function view(): View
    {
        return view('exports.sale-report-agency-group', [
            'agencies' => $this->agencies
        ]);
    }
}
