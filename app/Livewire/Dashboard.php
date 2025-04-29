<?php

namespace App\Livewire;

use App\Livewire\Setting\SystemLog;
use App\Models\Agency;
use App\Models\City;
use App\Models\Commune;
use App\Models\DailyExpend;
use App\Models\District;
use App\Models\OtherExpense;
use App\Models\Product;
use App\Models\Shop;
use App\Models\Village;
use Carbon\Carbon;
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
    public $last_month_start, $last_month_end;

    public function mount()
    {
        $this->start_date = now()->startOfMonth()->toDateString();
        $this->end_date = now()->toDateString();
        $this->last_month_start = Carbon::now()->subMonth()->startOfMonth()->toDateString();
        $this->last_month_end = Carbon::now()->subMonth()->endOfMonth()->toDateString();
    }

    public function render()
    {
        $current_expend = DailyExpend::query();
        $other_expend = OtherExpense::query();

        if ($this->start_date && $this->end_date) {
            $current_expend = $current_expend->whereBetween('created_at', [$this->start_date . ' 00:00:00 ', $this->end_date . ' 23:59:59 ']);
        }
        if ($this->start_date && $this->end_date) {
            $other_expend = $other_expend->whereBetween('created_at', [$this->start_date . ' 00:00:00 ', $this->end_date . ' 23:59:59 ']);
        }
        $current_expend = $current_expend->orderBy('created_at', 'DESC')->get();
        $other_expend = $other_expend->orderBy('created_at', 'DESC')->get();

        $last_month_expend = DailyExpend::query();
        if ($this->last_month_start && $this->last_month_end) {
            $last_month_expend = $last_month_expend->whereBetween('created_at', [$this->last_month_start . ' 00:00:00 ', $this->last_month_end . ' 23:59:59 ']);
        }
        $last_month_expend = $last_month_expend->orderBy('created_at', 'DESC')->get();
        return view(
            'livewire.dashboard',
            [
                'current_expend' => $current_expend,
                'other_expend' => $other_expend,
                'last_month_expend' => $last_month_expend,
            ]
        )->title('Dashboard');
    }
}
