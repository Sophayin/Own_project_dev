<?php

namespace App\Livewire\HRM;

use App\Models\Agency;
use App\Models\PayrollDetail;
use App\Models\Position;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class HRMList extends Component
{
    use WithPagination;
    protected $listener = ["update_status_payroll"];

    public $payroll_status;
    public $payroll;
    public $check_all;
    public $payrolls;
    public $action;
    public $start_date, $end_date, $search = '', $limit = 15;
    public $status = '%';
    public $positions;
    public $position_id;
    public $position_ids = [];
    public $agency_ids = [];
    public $form_action;
    protected $queryString = ['form_action'];
    public function agency_ids_payroll()
    {
        $agency_ids = PayrollDetail::groupBy('agency_id')->pluck('agency_id')->toArray();
        return array_unique($agency_ids);
    }

    public function mount($slug)
    {
        $get_agency_sale = new Agency();
        $this->action = $slug;
        $this->start_date = now()->startOfMonth()->format('Y-m-d');
        $this->end_date = today()->endOfMonth()->format('Y-m-d');
        $this->agency_ids = array_unique(array_merge($this->agency_ids, $get_agency_sale->get_main_agency_id_by_sale(), $get_agency_sale->get_agency_id_by_sale()));
    }

    public function render()
    {
        $this->dispatch('loadLeaderSelected');
        if ($this->action == 'performance') {
            $this->positions = Position::whereHas('agency', function ($q) {
                $q->whereIn("status", [1, 2]);
            })->orderBy('id', 'asc')->get();
            $agencies = DB::table('agencies as agency');
            if ($this->position_id > 0) {
                $agencies = $agencies->where('position_id', $this->position_id);
            }
            if ($this->search) {
                $txtSearch = trim($this->search);
                $agencies = $agencies->when($txtSearch, function ($query) use ($txtSearch) {
                    $query->where('code', 'ilike', '%' . $txtSearch . '%');
                    $query->orWhere('full_name', 'ilike', '%' . $txtSearch . '%');
                });
            }
            $agencies = $agencies->whereIn('agency.id', $this->agency_ids)
                ->select(
                    'agency.*',
                    DB::raw("(SELECT COUNT(*) FROM applications WHERE status = 2 AND applications.agency_id = agency.id AND applications.created_at BETWEEN '$this->start_date 00:00:00' AND '$this->end_date 23:59:59'
                        ) as direct_sale "),

                    DB::raw("(WITH RECURSIVE cte AS ( SELECT id, code, referrer_code, agency_id FROM agencies WHERE agency_id = agency.id
                            UNION SELECT a.id, a.code, a.referrer_code, a.agency_id FROM agencies a
                            JOIN cte ON cte.code = agency.referrer_code )
                            SELECT COUNT(*) FROM cte JOIN applications AS app ON app.agency_id = cte.id
                            WHERE app.created_at BETWEEN '$this->start_date 00:00:00' AND '$this->end_date 23:59:59'
                            AND cte.code <> agency.code AND app.status = 2
                        ) as sale_by_team "),

                    //    Recruit Total
                    DB::raw("(SELECT COUNT(*) FROM agencies WHERE status IN (1,2)
                            AND referrer_code = agency.code
                            AND code IS NOT NULL
                            AND created_at BETWEEN '$this->start_date 00:00:00 ' AND '$this->end_date 23:59:59 '
                        ) as direct_recruit "),

                    DB::raw("(WITH RECURSIVE cte AS (
                            SELECT id, agency_id, code, status FROM agencies WHERE code = agency.code
                            UNION SELECT a.id, a.agency_id, a.code, a.status FROM agencies a
                            JOIN cte ON cte.code = a.referrer_code )
                            SELECT COUNT(*) FROM cte
                                JOIN agencies b ON b.code = cte.code
                                JOIN agencies c ON c.referrer_code = cte.code AND c.status IN(1,2)
                                WHERE cte.agency_id = agency.id AND c.created_at BETWEEN '$this->start_date 00:00:00' AND '$this->end_date 23:59:59'
                                ) as recruit_by_team")
                )
                ->orderBy('agency.code', 'ASC')
                ->paginate($this->limit);
            return view('livewire.h-r-m.performance', ['agencies' => $agencies])->title("HRM - Performance");
        } elseif ($this->action == 'payroll') {
            $this->positions =  DB::table('positions')
                ->join('agencies', function (JoinClause $jion) {
                    $jion->on('positions.id', '=', 'agencies.position_id');
                })
                ->join('payroll_details', function (JoinClause $jion) {
                    $jion->on('agencies.id', '=', 'payroll_details.agency_id');
                })
                ->select('positions.*')
                ->groupBy('positions.id')
                ->orderBy('positions.id')
                ->get();

            $payroll_lists = PayrollDetail::where('status', 'like', $this->status);
            if (!empty($this->position_ids)) {
                $payroll_lists = $payroll_lists->whereHas('agency', function ($q) {
                    $q->WhereIn('position_id', $this->position_ids);
                });
            }
            $payroll_lists = $payroll_lists->whereHas('agency', function ($q) {
                $q->Where('full_name', 'ilike', '%' . $this->search . '%');
                $q->orWhere('code', 'ilike', '%' . $this->search . '%');
                $q->orWhere('full_name_translate', 'ilike', '%' . $this->search . '%');
                $q->orWhere('phone', 'ilike', '%' . $this->search . '%');
            })
                ->whereBetween('created_at', [$this->start_date . ' 00:00:00 ', $this->end_date . ' 23:59:59 '])
                ->get();
            $this->payrolls = $payroll_lists;
            return view('livewire.h-r-m.payroll')->title("HRM - Payroll");
        }
    }

    public function update_status_payroll($payroll_id)
    {
        if (in_array('Edit Payroll Status', session('user_permission')['Payroll'])) {
            $this->payroll = PayrollDetail::where('id', $payroll_id)->first();
            $this->payroll_status = $this->payroll->status;
            $this->dispatch('modal.updateStatus');
        } else {
            $this->dispatch("alert.message", [
                'type' => 'warning',
                'message' => __("Access Denied! You don't have permission to access this function. Request access from your administrator")
            ]);
        }
    }

    public $selected_payrolls = [];

    public function updatedCheckAll($value)
    {
        if ($value)
            $this->selected_payrolls = $this->payrolls->pluck('id')->toArray();
        else
            $this->selected_payrolls = [];
    }

    public function preview()
    {
        if (count($this->selected_payrolls) > 0)
            return redirect()->to('/payroll/preview')->with(['payrolls' => $this->selected_payrolls]);
    }

    public function updateStatus()
    {
        $this->payroll->status = $this->payroll_status;
        $this->payroll->save();
        create_transaction_log(Auth::user()->name . ' : ' . Auth::user()->name, $this->payroll_status ? "Unpaid" : "Paid", __('updated payment') . ' ' . Auth::user()->name . ' ' . __('successfully') . ' ', Auth::user()->name);

        $this->dispatch('alert.message', [
            'type' => 'success',
            'message' => __('Agency status has been updated'),
        ]);
    }

    public function open_modal_payroll()
    {
        if (in_array('Generate Payroll', session('user_permission')['Payroll'])) {
            $this->dispatch('modal.openModal');
        } else {
            $this->dispatch("alert.message", [
                'type' => 'warning',
                'message' => __("Access Denied! You don't have permission to access this function. Request access from your administrator")
            ]);
        }
    }
    public function open_modal_commission()
    {
        $this->dispatch('modal.openModalCommission');
    }
}
