<?php


namespace App\Exports;

use App\Invoice;
use App\Models\Payroll;
use App\Models\PayrollDetail;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class PayrollExport implements FromView
{
    private $payroll_id;

    public function __construct($payroll_id)
    {
        $this->payroll_id = $payroll_id;
    }

    public function view(): View
    {
        return view('exports.payroll', [
            'payrolls' => PayrollDetail::whereIn('id', $this->payroll_id)->get()
        ]);
    }
}
