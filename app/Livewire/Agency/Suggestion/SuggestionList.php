<?php

namespace App\Livewire\Agency\Suggestion;

use App\Livewire\HRM\HRMList;
use App\Models\Agency;
use App\Models\AwardTarget;
use App\Models\Position;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class SuggestionList extends Component
{
    public $search = "";
    public $start_date, $end_date;
    public $referrer_code;
    public $agency_id;
    public $overide_agancy_ids = [];
    public $agencies = [];
    public $agency_suggestion = [];
    public $action;
    protected $queryString = ['action', 'agency_id'];

    public function mount()
    {
        $this->start_date = today()->subMonths(3)->format('Y-m-d');
        $this->end_date = today()->format('Y-m-d');
    }

    public function fetch_agencies()
    {
        $get_agencies = DB::table('payroll_details')
            ->leftJoin('agencies', function ($q) {
                $q->on('payroll_details.agency_code', '=', 'agencies.code');
            })
            ->whereIn('agencies.status', [1, 2])
            ->where('agencies.position_id', '<>', 1)
            ->whereBetween('payroll_details.created_at', ["$this->start_date 00:00:00", "$this->end_date 23:59:59"])
            ->groupBy('agencies.id')
            ->select(
                "agencies.*",
                DB::raw("(SELECT SUM(total_sale) FROM payroll_details where agency_id = agencies.id AND created_at between '$this->start_date 00:00:00' AND '$this->end_date 23:59:59' ) as total_sale "),
                DB::raw("(SELECT SUM(total_recruit) FROM payroll_details where agency_id = agencies.id AND created_at between '$this->start_date 00:00:00' AND '$this->end_date 23:59:59' ) as total_recruit ")
            )
            ->get();

        $this->agency_suggestion = [];
        foreach ($get_agencies as $agency) {
            $position = Position::find($agency->position_id);
            if ($agency->position_id == 5) {
                if ($agency->total_sale >= 3 & $agency->total_recruit >= 10)
                    $this->agency_suggestion[] = [
                        'id' => $agency->id,
                        'code' => $agency->code,
                        'position_id' => $agency->position_id,
                        'full_name' => $agency->full_name,
                        'full_name_translate' => $agency->full_name_translate,
                        'gender' => $agency->gender,
                        'phone' => $agency->phone,
                        'income' => $agency->income,
                        'position' => $position->name ?? '',
                        'phone_telegram' => $agency->phone_telegram,
                        'khmer_identity_card' => $agency->khmer_identity_card,
                    ];
            } else {
                $check_award = AwardTarget::where('position_id', $agency->position_id)->orderBy('award_id', 'desc')->first();
                if ($check_award) {
                    if ($check_award->target_sale <= $agency->total_sale && $check_award->target_recruit <= $agency->total_recruit) {
                        $this->agency_suggestion[] = [
                            'id' => $agency->id,
                            'code' => $agency->code,
                            'position_id' => $agency->position_id,
                            'full_name' => $agency->full_name,
                            'full_name_translate' => $agency->full_name_translate,
                            'gender' => $agency->gender,
                            'phone' => $agency->phone,
                            'income' => $agency->income,
                            'position' => $position->name ?? '',
                            'phone_telegram' => $agency->phone_telegram,
                            'khmer_identity_card' => $agency->khmer_identity_card,
                        ];
                    }
                }
            }
        }
    }

    public function render()
    {
        $this->fetch_agencies();
        return view('livewire.agency.suggestion.suggestion-list')->title('Promote List');
    }
}
