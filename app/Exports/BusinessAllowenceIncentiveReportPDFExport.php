<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class BusinessAllowenceIncentiveReportPDFExport implements

    FromView
{
    private $agencyIncentives;

    public function __construct($agencyIncentives)
    {
        $this->$agencyIncentives = $$agencyIncentives;
    }

    public function view(): View
    {
        return view('exports.pdf.allowence-incentive-report', [
            'agencyIncentives' => $this->agencyIncentives,
        ]);
    }
}
