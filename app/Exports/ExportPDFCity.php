<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class ExportPDFCity implements FromView
{
    public $city_id, $cities;
    public function __construct($city_id, $cities)
    {
        $this->city_id = $city_id;
        $this->cities = $cities;
    }
    public function view(): View
    {
        return view('exports.pdf.city-info', ['city_id' => $this->city_id, 'cities' => $this->cities]);
    }
}
