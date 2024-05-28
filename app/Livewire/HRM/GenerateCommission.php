<?php

namespace App\Livewire\HRM;

use App\Models\Agency;
use App\Models\AgencySetting;
use App\Models\Application;
use App\Models\Payroll;
use App\Models\PayrollDetail;
use Carbon\Carbon;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Illuminate\Support\Str;


class GenerateCommission extends Component
{
    public function render()
    {
        $this->dispatch('loadPosition');
        return view('livewire.h-r-m.generate-commission');
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
    public $commission_fee;
    public $override_fee;

    public function mount()
    {
        $commission = AgencySetting::first();
        $this->commission_fee = $commission->commission_fee;
        $this->override_fee = $commission->override_fee;
        $this->start_date = now()->startOfMonth()->format('Y-m-d');
        $this->end_date = today()->format('Y-m-d');
        $this->agency_positions = DB::table('positions')
            ->join('agencies', function (JoinClause $jion) {
                $jion->on('positions.id', '=', 'agencies.position_id');
            })
            ->join('applications', function (JoinClause $jion) {
                $jion->on('agencies.id', '=', 'applications.agency_id');
            })
            ->where('applications.status', 2)
            ->where('applications.is_payroll', false)
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


    public function fetch_sales()
    {
        $agencies = Agency::whereIn('position_id',  $this->agency_position_ids)
            ->whereHas('applications', function ($q) {
                $q->whereIn('status', [2]);
                $q->where('is_payroll', false);
                $q->whereBetween('created_at', [$this->start_date . ' 00:00:00', $this->end_date . ' 23:59:59']);
            })->get();
        $this->sales = [];

        foreach ($agencies as $agency) {
            $payroll_application_ids = [];
            $agency_id = $agency->id;
            $payroll_details = $this->get_payroll($agency_id);

            if ($payroll_details) {
                if ($payroll_details->application_ids)
                    $payroll_application_ids = json_decode($payroll_details->application_ids, true);
            }

            $applications = Application::where('status', 2)
                ->whereIn('agency_id', [$agency_id])
                ->whereNotIn('id', $payroll_application_ids)
                ->whereBetween('created_at', [$this->start_date . ' 00:00:00', $this->end_date . ' 23:59:59'])
                ->get();
            $own_sale = $this->get_direct_sale($agency_id)->count(0);
            $application_ids = $applications->pluck('id')->toJson();
            $agency_ids = $this->get_down_line_ids($agency_id);

            $agency_codes = $this->get_down_line_code([$agency_id]);
            $total_recruit = $this->get_total_recruit($agency_codes, $agency_ids)['count'];
            $agency_data_award_checking = [
                'agency_id' => $agency_id,
                'position_id' => $agency->position_id,
                'own_sale' => $own_sale,
                //'sale_by_team' => $sale_by_team,
                //'indirect_sale_team' => $indirect_sale_team,
                'total_sale' => $own_sale,
                'total_recruit' => $total_recruit,
            ];

            $award_data = (new PayrollGenerate())->check_award($agency_data_award_checking);
            if ($own_sale == 00) {
                continue;
            }

            $this->sales[] = [
                'agency_id' => $agency_id,
                'agency_code' => $agency->code,
                'agency_name' => $agency->full_name,
                'position' => $agency->position->name ?? '',
                'own_sale' => $own_sale,
                'total_sale' => $own_sale,
                'total_recruit' => $total_recruit,
                'commission_fee' => $award_data['commission_fee'],
                'override_fee' => $award_data['override_fee'],
                'total_payment' => (float)$award_data['commission_fee'] + (float)$award_data['override_fee'],
                'remark' => '',
                'label_award' => $award_data['award_name'],
                'recruit_ids' => $agency_id,
                'application_ids' => $application_ids,
            ];
        }
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

    public function calculate_commission($direct_sale)
    {
        $commission = AgencySetting::first();
        return $commission->commission_fee * $direct_sale;
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
                $create->total_sale = $this->sales[$index]['total_sale'];
                $create->commission_fee = $this->sales[$index]['commission_fee'];
                $create->remark = $this->sales[$index]['remark'];
                $create->application_ids = $this->sales[$index]['application_ids'];
                $create->total_payroll = $this->sales[$index]['total_payment'];
                $create->status = false;
                $create->save();

                application::where('status', 2)
                    ->where('is_payroll', false)
                    ->where('agency_id', $this->sales[$index]['agency_id'])
                    ->whereBetween('created_at', [$this->start_date . ' 00:00:00', $this->end_date . ' 23:59:59'])
                    ->update(['is_payroll' => true]);
            }
        }

        $this->dispatch("alert.message", [
            'type' => 'success',
            'message' => __("Data has been saved Successfully")
        ]);
        create_transaction_log(__('Generate commission sale') . ' : ' . Auth::user()->name, 'Commission', __('commission') . ' ' . Auth::user()->name . ' ' . __('successfully') . ' ', Auth::user()->name);
        $this->dispatch('modal.closeModal');
        $this->dispatch('refresh_payroll');
        $this->sales = [];
        $this->selected_items = [];
        $this->check_all = false;
    }

    public function updated($name, $value)
    {
        $item = explode('.', $name);
        if (Str::contains($name, 'sales')) {
            if ($item[2] == 'commission_fee') {
                $total_payroll = 0;
                $total_payroll = (float)$this->sales[$item[1]]['commission_fee'];
                $this->sales[$item[1]]['total_payroll'] = $total_payroll;
            }
        }
    }
}
