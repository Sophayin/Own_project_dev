<?php

namespace App\Exports;

use App\Models\Agency;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class ExportFileExcel implements FromView
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {
        $agencies = Agency::first();
        return view('exports.agency-sample-excel', ['agencies' => $agencies]);
    }
}
