<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class MFIExport implements FromView
{
    public $MFI;
    public function __construct($MFI)
    {
        $this->MFI = $MFI;
    }
    public function view(): View
    {
        return view('export.pdf.MFI', ['MFI' => $this->MFI]);
    }
}
