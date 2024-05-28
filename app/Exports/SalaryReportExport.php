<?php

namespace App\Exports;

use App\Models\PayrollDetail;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class SalaryReportExport implements FromView
{
    public $positionsToRetrieve, $start_date, $end_date;
    public function __construct($positionsToRetrieve, $start_date, $end_date)
    {
        $this->start_date = $start_date;
        $this->end_date = $end_date;
        $this->positionsToRetrieve = $positionsToRetrieve;
    }
    public function view(): View
    {
        $positionsToRetrieve = [2, 3, 4];

        $agenciesPayroll = PayrollDetail::whereHas('agency', function ($query) use ($positionsToRetrieve) {
            $query->whereIn('position_id', $positionsToRetrieve);
        })->get();
        return view('exports.salary-report', ['start_date' => $this->start_date, 'end_date' => $this->end_date, 'agenciesPayroll' => $agenciesPayroll]);
    }
}
