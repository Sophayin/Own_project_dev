<?php

namespace App\Livewire\Agency;

use App\Models\City;
use App\Services\DownloadPdfService;
use Livewire\Component;

class DownloadRegion extends Component
{
    public $cities;
    public $city_id;
    public $city;
    protected $rules = [
        'city_id' => 'required'
    ];

    public function render()
    {
        $this->cities = City::orderBy('name', 'asc')->orderBy('name', 'asc')->get();
        $this->city = City::find($this->city_id);
        return view('livewire.agency.download-region', ['cities' => $this->cities]);
    }

    public function downloadCity()
    {
        $this->validate();
        $pdf = new DownloadPdfService($this->city->name . '.pdf', 'exports.pdf.city-info', ['city' => $this->city]);
        return $pdf->download();
    }
}
