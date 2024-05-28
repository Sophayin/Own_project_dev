<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class AllowenceIncentiveExport implements FromView
{
    private $data;
    public $start_date, $end_date;
    public function __construct($data, $start_date, $end_date)
    {
        $this->data = $data;
        $this->start_date = $start_date;
        $this->end_date = $end_date;
    }
    public function view(): View
    {
        return view('exports.allowence-incentive-report', ['agencyIncentives' => $this->data, 'start_date' => $this->start_date, 'end_date' => $this->end_date]);
    }
}
