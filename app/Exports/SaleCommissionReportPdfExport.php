<?php

namespace App\Exports;

use App\Models\PayrollDetail;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class SaleCommissionReportPdfExport implements FromView
{
    public function view(): View
    {
        $agenciesPayroll = PayrollDetail::whereHas('agency', function ($query) {
            $query->where('position_id', '=', 5);
        })->get();
        return view('exports.pdf.sale-commission', [
            'agenciesPayroll' => $agenciesPayroll,
        ]);
    }
}
