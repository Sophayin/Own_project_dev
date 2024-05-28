<?php

namespace App\Livewire\Report\Agency;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class TrainingReport extends Component
{
    public $start_date, $end_date;
    public $getShops, $getCities;
    public function render()
    {
        return view('livewire.report.agency.training-report')->layout('layouts.frontend');
    }
    public function mount()
    {
        $this->start_date = now()->startOfDay()->toDateString();
        $this->end_date = now()->endOfMonth()->toDateString();
        $this->getShops = DB::table('shops')
            ->join('applications', 'shops.id', '=', 'applications.shop_id')
            ->select('shops.*', 'shop_id')
            ->distinct()
            ->get();

        $this->getCities = DB::table('addresss')
            ->leftJoin('applications', 'applications.id', '=', 'addresss.application_id')
            ->leftJoin('cities', 'cities.id', '=', 'addresss.city_id')
            ->whereNotNull('applications.id')
            ->select('cities.*', 'city_id')
            ->groupBy('cities.id', 'addresss.city_id')
            ->get();
    }
}
