<?php

namespace App\Exports;

use App\Models\PayrollDetail;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class SalaryReportPdfExport implements FromView
{
    public function view(): View
    {
        $agenciesPayroll = PayrollDetail::whereHas('agency', function ($query) {
            $query->whereIn('position_id', [2, 3, 4]);
        })->get();
        return view(
            'exports.pdf.salary-report',
            [
                'agenciesPayroll' => $agenciesPayroll
            ]
        );
    }
}
