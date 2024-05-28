<?php

namespace App\Livewire\HRM;

use App\Models\Agency;
use App\Models\AgencySetting;
use App\Models\Application;
use App\Models\AwardTarget;
use App\Models\Payroll;
use App\Models\PayrollDetail;
use App\Models\Position;
use Carbon\Carbon;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Illuminate\Support\Str;

class PayrollGenerate extends Component
{
    public function render()
    {
        $this->dispatch('loadPosition');
        return view('livewire.h-r-m.payroll-generate');
    }

    public $start_date;
    public $end_date;
    public $sales;
    public $applications;
    public $selected_items = [];
    public $check_all;
    public $agency_position_ids = [];
    public $agency_positions;
    public $award_target;
    public $commission_fee = 0;
    public $override_fee = 0;

    public function mount()
    {
        $this->start_date = now()->startOfMonth()->format('Y-m-d');
        $this->end_date = today()->format('Y-m-d');
        $this->agency_positions = DB::table('positions')
            ->join('agencies', function (JoinClause $jion) {
                $jion->on('positions.id', '=', 'agencies.position_id');
            })
            ->whereNotIn('positions.id', [1, 2, 5])
            ->whereIn('agencies.status', [1, 2])
            ->select('positions.*')
            ->groupBy('positions.id')
            ->orderBy('positions.id')
            ->get();

        $this->fetch_sales();
    }

    public function updatedAgencyPositionIds()
    {
        $this->fetch_sales();
    }

    public function updatedDateFrom()
    {
        $this->fetch_sales();
    }

    public function updatedDateTo()
    {
        $this->fetch_sales();
    }

    public function updatedCheckAll($value)
    {
        if ($value)
            $this->selected_items = array_keys($this->sales);
        else
            $this->selected_items = [];
    }

    public function agency_children_children_ids($agency_ids)
    {
        $agency_children = Agency::whereIn('id', $agency_ids)->get();
        $agency_childrem_ids = [];
        foreach ($agency_children as $item) {
            $agency_childrem_ids = array_merge($agency_childrem_ids, $item->children->pluck('id')->toArray());
        }
        return $agency_childrem_ids;
    }

    public $agencies;
    public function fetch_sales()
    {
        $agencies = Agency::whereIn('position_id',  $this->agency_position_ids)
            ->whereHas('applications', function ($q) {
                $q->whereIn('status', [2]);
                $q->whereBetween('created_at', [$this->start_date . ' 00:00:00', $this->end_date . ' 23:59:59']);
            })
            ->get();
        $this->agencies = $agencies;
        $this->sales = [];
        foreach ($agencies as $agency) {
            $agency_children_ids = $agency->children->pluck('id')->toArray();
            $agency_children_children_ids = $this->agency_children_children_ids($agency_children_ids); // $agency->children->pluck('id')->toArray();
            $payroll_application_ids = [];
            $payroll_recruit_ids = [];
            $agency_id = $agency->id;
            $agency_ids = $this->get_down_line_ids($agency_id);
            $agency_codes = $this->get_down_line_code($agency_ids);
            $payroll_details = $this->get_payroll($agency_id);

            if ($payroll_details) {
                if ($payroll_details->application_ids)
                    $payroll_application_ids = json_decode($payroll_details->application_ids, true);
                if ($payroll_details->recruit_ids)
                    $payroll_recruit_ids = json_decode($payroll_details->recruit_ids, true);
            }

            $applications = Application::where('status', 2)
                ->whereIn('agency_id', $agency_children_ids)
                ->whereNotIn('id', $payroll_application_ids)
                ->whereBetween('created_at', [$this->start_date . ' 00:00:00', $this->end_date . ' 23:59:59'])
                ->get();

            $applications_indirect = Application::where('status', 2)
                ->whereIn('agency_id', $agency_children_children_ids)
                ->whereNotIn('id', $payroll_application_ids)
                ->whereBetween('created_at', [$this->start_date . ' 00:00:00', $this->end_date . ' 23:59:59'])
                ->get();
            $indirect_sale_application = $applications_indirect->pluck('id')->toArray();
            $team_sale_application_ids = $applications->pluck('id')->toArray();
            $application_ids = array_merge($team_sale_application_ids, $indirect_sale_application);
            array_push($agency_codes, $agency->code);
            $own_sale = $this->get_direct_sale($agency_id)->count();
            $sale_by_team = $applications->count();
            $indirect_sale_team = $applications_indirect->count();

            $total_sale = $sale_by_team + $own_sale + $indirect_sale_team;
            $total_recruit = $this->get_total_recruit($agency_codes, $payroll_recruit_ids)['count'];
            $recruit_ids = $this->get_total_recruit($agency_codes, $payroll_recruit_ids)['ids'];
            $agency_data_award_checking = [
                'agency_id' => $agency_id,
                'position_id' => $agency->position_id,
                'own_sale' => $own_sale,
                'sale_by_team' => $sale_by_team,
                'indirect_sale_team' => $indirect_sale_team,
                'total_sale' => $total_sale,
                'total_recruit' => $total_recruit,
            ];

            if ($total_sale == 00) {
                continue;
            }

            $award_data = $this->check_award($agency_data_award_checking);
            $total_payroll = $award_data['salary'] + $award_data['commission_fee'] + $award_data['override_fee'] + $award_data['incentive'];
            $this->sales[] = [
                'agency_id' => $agency_id,
                'agency_code' => $agency->code,
                'agency_name' => $agency->full_name,
                'position' => $agency->position->name,
                'own_sale' => $own_sale,
                'sale_by_team' => $sale_by_team,
                'indirect_sale_team' => $indirect_sale_team,
                'total_sale' => $total_sale,
                'target_sale' => $award_data['target_sale'],
                'total_recruit' => $total_recruit,
                'target_recruit' => $award_data['target_recruit'],

                'incentive' => $award_data['incentive'],
                'commission_fee' => $award_data['commission_fee'],
                'override_fee' => $award_data['override_fee'],
                'salary' => $award_data['salary'],

                'total_payroll' => $total_payroll,
                'remark' => '',
                'award_name' => $award_data['award_name'],
                'recruit_ids' => $recruit_ids,
                'application_ids' => json_encode($application_ids),
            ];
        }
    }

    public function get_direct_sale($agency_id)
    {
        $applications = Application::where('status', 2)
            ->where('is_payroll', false)
            ->where('agency_id', $agency_id)
            ->whereBetween('created_at', [$this->start_date . ' 00:00:00', $this->end_date . ' 23:59:59'])
            ->get();

        return $applications;
    }

    public function get_payroll($agency_id)
    {
        $payroll_details = PayrollDetail::where('agency_id', $agency_id)
            ->whereBetween('created_at', [$this->start_date . ' 00:00:00', $this->end_date . ' 23:59:59'])
            ->first();

        return $payroll_details;
    }

    public function get_total_recruit($agency_code, $recruit_ids)
    {
        $recruits = Agency::whereIn('referrer_code', $agency_code)
            ->whereNotIn('id', $recruit_ids)
            ->whereBetween('created_at', [$this->start_date . ' 00:00:00', $this->end_date . ' 23:59:59'])
            ->get();
        $data = [
            'ids' => $recruits->pluck('id')->toJson(),
            'count' => $recruits->count()
        ];
        return $data;
    }

    public function check_award($data)
    {
        $commission = AgencySetting::first();
        $this->commission_fee = $commission->commission_fee;
        $this->override_fee = $commission->override_fee;

        $agency_awards = AwardTarget::where('position_id', $data['position_id'])
            ->where('target_sale', '<=', $data['total_sale'])
            ->where('target_recruit', '<=', $data['total_recruit'])
            ->get();
        if ($data['position_id'] == 5) {
            $label_award = '';
            $commission = $this->commission_fee * $data['total_sale'];
            $override_fee = 0;
            if ($data['total_sale'] >= 3 && $data['total_recruit'] >= 3) {
                $override_fee = $this->override_fee * $data['total_recruit'];
                $commission = 150;
                $label_award = "Super LC";
                if ($data['total_recruit'] >= 10) {
                    $override_fee = 50;
                }
            }
            return [
                'award_id' =>  0,
                'award_name' => $label_award,
                'target_sale' => 3,
                'target_recruit' => 3,
                'salary' => 0,
                'incentive' => 0,
                'override_fee' => $override_fee,
                'commission_fee' => $commission,
                'is_award' => false,
            ];
        } else {
            $_award = [
                'award_id' => 0,
                'award_name' => '',
                'target_sale' => 0,
                'target_recruit' => 0,
                'salary' => 0,
                'incentive' => 0,
                'commission_fee' => $this->commission_fee,
                'override_fee' => 0,
                'is_award' => false,
            ];
            foreach ($agency_awards as $award) {
                if ($data['total_sale'] >= $award->target_sale && $data['total_recruit'] >= $award->target_recruit) {
                    $_award = [
                        'award_id' => $award->award_id,
                        'award_name' => $award->award->name,
                        'target_sale' => $award->target_sale,
                        'target_recruit' => $award->target_recruit,
                        'salary' => $award->salary,
                        'incentive' => $award->incentive,
                        'override_fee' => $award->override_fee * $data['total_sale'],
                        'commission_fee' => 0,
                        'is_award' => true,
                    ];
                }
            }
            return $_award;
        }
    }

    public function get_down_line_ids($agency_id)
    {
        $agency_ids = DB::select("WITH RECURSIVE cte AS (
            SELECT id, agency_id FROM agencies WHERE id = :agencyId
            UNION SELECT a.id, a.agency_id FROM agencies a
            JOIN cte ON cte.id = a.agency_id
            )
            SELECT id FROM cte where id != :agencyId", ['agencyId' => $agency_id,]);

        $agency_ids = array_column($agency_ids, 'id');
        return $agency_ids;
    }

    public function get_down_line_code($agency_ids)
    {
        $agency_codes = Agency::whereIn('id', $agency_ids)->pluck('code')->toArray();
        return $agency_codes;
    }

    private function generateUniqueCode()
    {
        $latest_payroll = Payroll::latest('id')->first();
        $nextCodeNumber = ($latest_payroll) ? intval($latest_payroll->code) + 1 : 230000;
        $formattedCode = str_pad($nextCodeNumber, 6, '0', STR_PAD_LEFT);
        return $formattedCode;
    }

    public function submit()
    {
        if (count($this->selected_items) == 0) {
            $this->dispatch('alert.message', [
                'type' => 'error',
                'message' => __("Please select at least one row to proceed.")
            ]);
            return;
        }
        $payroll_reference = $this->generateUniqueCode();
        $create_payroll = new Payroll();
        $create_payroll->payroll_reference = $payroll_reference;
        $create_payroll->transaction_at = Carbon::now();
        $create_payroll->transaction_by = Auth::id();
        $create_payroll->status = true;
        $create_payroll->save();
        foreach ($this->selected_items as $index) {
            if (isset($this->sales[$index])) {
                $create = new PayrollDetail();
                $create->payroll_reference = $payroll_reference;
                $create->agency_id = $this->sales[$index]['agency_id'];
                $create->agency_code = $this->sales[$index]['agency_code'];
                $create->own_sale = $this->sales[$index]['own_sale'];
                $create->sale_by_team = $this->sales[$index]['sale_by_team'];
                $create->total_sale = $this->sales[$index]['total_sale'];
                $create->target_sale = $this->sales[$index]['target_sale'];
                $create->total_recruit = $this->sales[$index]['total_recruit'];
                $create->target_recruit = $this->sales[$index]['target_recruit'];
                $create->incentive = $this->sales[$index]['incentive'];
                $create->commission_fee = $this->sales[$index]['commission_fee'];
                $create->salary = $this->sales[$index]['salary'];
                $create->override_fee = $this->sales[$index]['override_fee'];
                $create->remark = $this->sales[$index]['remark'];
                $create->application_ids = $this->sales[$index]['application_ids'];
                $create->recruit_ids = $this->sales[$index]['recruit_ids'];
                $create->total_payroll = $this->sales[$index]['total_payroll'];
                $create->status = false;
                $create->save();

                application::where('status', 2)
                    ->where('is_payroll', false)
                    ->where('agency_id', $this->sales[$index]['agency_id'])
                    ->whereBetween('created_at', [$this->start_date . ' 00:00:00', $this->end_date . ' 23:59:59'])
                    ->update(['is_payroll' => true]);
            }
        }

        create_transaction_log(Auth::user()->name . ' : ' . Auth::user()->name, 'Payroll', __('Generate Payroll success') . ' ' . Auth::user()->name . ' ' . __('successfully') . ' ', Auth::user()->name);

        $this->dispatch("alert.message", [
            'type' => 'success',
            'message' => __("Data has been saved Successfully")
        ]);

        $this->dispatch('modal.closeModal');
        $this->dispatch('refresh_payroll');
        $this->sales = [];
        $this->selected_items = [];
        $this->check_all = false;
    }
    public function update()
    {
        $this->start_date = $this->start_date;
        $this->end_date = $this->end_date;
    }
    public function updated($name, $value)
    {
        $item = explode('.', $name);
        if (Str::contains($name, 'sales')) {
            if ($item[2] == 'salary' || $item[2] == 'override_fee' || $item[2] == 'incentive') {
                $total_payroll = 0;
                $total_payroll = (float)$this->sales[$item[1]]['salary'] + (float)$this->sales[$item[1]]['incentive'] + (float)$this->sales[$item[1]]['override_fee'];
                $this->sales[$item[1]]['total_payroll'] = $total_payroll;
            }
        }
    }
}
