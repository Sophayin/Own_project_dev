<?php

namespace App\Livewire\Agency\Suggestion;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use Symfony\Component\CssSelector\Node\FunctionNode;

class DemoteList extends Component
{
    use WithPagination;
    public $search = "";
    public $start_date, $end_date;
    public $agency_id, $referrer_code;
    public $agency_suggestion = [];
    public $action;
    protected $queryString = ['action', 'agency_id'];

    public function render()
    {
        $threeMonths = Carbon::now()->subMonths(3)->toDateString();
        $agencies = DB::table('agencies')
            ->leftJoin('applications', function ($join) use ($threeMonths) {
                $join->on('agencies.id', '=', 'applications.agency_id')
                    ->whereBetween('applications.created_at', ["$threeMonths 00:00:00", now()->toDateTimeString()]);
            })
            ->whereNull('applications.id')
            ->where('agencies.created_at', '<', $threeMonths)
            ->whereNotIn('agencies.position_id', [1, 5])
            ->select('agencies.*');

        if ($this->search) {
            $txtSearch = trim($this->search);
            $agencies = $agencies->where(function ($query) use ($txtSearch) {
                $query->where('agencies.code', 'ilike', '%' . $txtSearch . '%')
                    ->orWhere('agencies.full_name', 'ilike', '%' . $txtSearch . '%');
            });
        }
        $agencies = $agencies->paginate(15);
        return view('livewire.agency.suggestion.demote-list', ['agencies' => $agencies])->title('demote-list');
    }
}
