<?php

namespace App\Exports\pdf;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class OccupationExport implements FromView
{
    public $occupations;
    public function __construct($occupation)
    {
        $this->occupations = $occupation;
    }
    public function view(): View
    {
        return view('exports.pdf.occupation', [
            'occupations' => $this->occupations,
        ]);
    }
}
