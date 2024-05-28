<?php


namespace App\Exports;

use App\Invoice;
use App\Models\Payroll;
use App\Models\PayrollDetail;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class OverwriteCommissionPdfExport implements FromView
{
    private $payrolls;

    public function __construct($payrolls)
    {
        $this->payrolls = $payrolls;
    }

    public function view(): View
    {
        return view('exports.overwrite-commission-report', [
            'agenciesPayroll' => $this->payrolls
        ]);
    }
}
