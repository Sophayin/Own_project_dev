<?php

namespace App\Exports;

use App\Models\Agency;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class RecruitByPositionPdfExport implements FromView
{
    public $agency, $position_id, $city_id;
    public function __construct($agencies, $position_id, $city_id)
    {
        $this->agency = $agencies;
        $this->position_id = $position_id;
        $this->city_id = $city_id;
    }
    public function view(): View
    {
        return view('exports.pdf.recruit-report-by-position', [
            'agency' => $this->agency,
            'position_id' => $this->position_id,
            'city_id' => $this->city_id,
        ]);
    }
}
