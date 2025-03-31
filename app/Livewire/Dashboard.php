<?php

namespace App\Livewire;

use App\Livewire\Setting\SystemLog;
use App\Models\Agency;
use App\Models\City;
use App\Models\Commune;
use App\Models\District;
use App\Models\Product;
use App\Models\Shop;
use App\Models\Village;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Dashboard extends Component
{
    public $cities = [];
    public $districts = [];
    public $communes = [];
    public $villages = [];
    public $city_id, $district_id, $commune_id;
    public $start_date, $end_date;

    public function render()
    {
        $user = auth()->user();
        //--query only agencies that has children--
        //if ($this->start_date && $this->end_date) {
        //    $agencies = $agencies->whereBetween('updated_at', [$this->start_date . ' 00:00:00 ', $this->end_date . ' 23:59:59 ']);
        //}
        //if ($this->start_date && $this->end_date) {
        //    $recruitAgencies = $recruitAgencies->whereBetween('updated_at', [$this->start_date . ' 00:00:00 ', $this->end_date . ' 23:59:59 ']);
        //}
        //if ($this->start_date && $this->end_date) {
        //    $latestActions = $latestActions->whereBetween('created_at', [$this->start_date . ' 00:00:00 ', $this->end_date . ' 23:59:59 ']);
        //}

        //$this->cities = City::orderBy('name', 'asc')->orderBy('name', 'asc')->get();
        //$this->districts = District::where('city_id', $this->city_id)->orderBy('name', 'asc')->get();
        //$this->communes = Commune::where('district_id', $this->district_id)->orderBy('name', 'asc')->get();
        //$this->villages = Village::where('commune_id', $this->commune_id)->orderBy('name', 'asc')->get();

        return view(
            'livewire.dashboard',
            [
                'user' => $user,
            ]
        )->title('Dashboard');
    }
    public function mount()
    {
        $this->start_date = now()->startOfMonth()->toDateString();
        $this->end_date = now()->endOfMonth()->toDateString();
    }
}
