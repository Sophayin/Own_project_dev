<?php

namespace App\Exports\pdf;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class PositionExport implements FromView
{
    public $positions;
    public function __construct($position)
    {
        $this->positions = $position;
    }
    public function view(): View
    {
        return view('exports.pdf.position', [
            'positions' => $this->positions,
        ]);
    }
}
