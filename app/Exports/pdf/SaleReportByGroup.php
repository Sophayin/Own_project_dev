<?php

namespace App\Exports\pdf;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class SaleReportByGroup implements FromView
{
    private $agencies;
    public function view(): View
    {
        return view('exports.pdf.sale-report-by-group', [
            'applications' => $this->agencies,
        ]);
    }
}
