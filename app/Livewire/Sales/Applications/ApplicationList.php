<?php

namespace App\Livewire\Sales\Applications;

use App\Models\Application;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class ApplicationList extends Component
{
    use WithPagination;
    public $getCities = [];
    public $getShops = [];
    public $search;
    public $shop_id;
    public $filter_by_status;
    public $selected_city;
    public $date_range = '';
    public $start_date;
    public $end_date;
    public $filteredData;
    public $loan_company;
    public $application_id;
    public $status;
    public $action;
    public $city_id;
    public $applicationFilter;
    public $getpositions, $position_id;
    protected $listeners = ['refresh_application' => 'render'];
    protected $queryString = ['action', 'application_id'];
    public function render()
    {
        $this->action = $this->action;
        $applications = Application::query();
        if ($this->search) {
            $applications = $applications->where('client_name', 'ilike', '%' . $this->search . '%')
                ->orWhere('code', 'ilike', '%' . $this->search . '%')
                ->orWhere('agency_code', 'ilike', '%' . $this->search . '%')
                ->orWhere('client_name_translate', 'ilike', '%' . $this->search . '%')
                ->orWhere('phone', 'ilike', '%' . $this->search . '%')
                ->whereHas('shop', function ($q) {
                    $q->orWhere('shop_name', 'ilike', '%' . $this->search . '%');
                });
        }

        if ($this->shop_id) {
            $applications = $applications->where('shop_id', $this->shop_id);
        }
        if ($this->position_id) {
            $applications = $applications->whereHas('agency.position', function ($query) {
                $query->where('id', $this->position_id);
            });
        }
        if ($this->filter_by_status != null) {
            $applications = $applications->where('status', $this->filter_by_status);
        }

        if ($this->start_date && $this->end_date) {
            $applications = $applications->whereBetween('created_at', [$this->start_date . ' 00:00:00 ', $this->end_date . ' 23:59:59 ']);
        }
        if ($this->city_id != '') {
            $applications = $applications->whereHas('address', function ($query) {
                $query->where('city_id', $this->city_id);
            });
        }
        $applications = $applications->orderBy('created_at', 'DESC')->paginate(10);
        return view('livewire.sales.applications.application-list', ['applications' => $applications, 'application' => $this->applicationFilter]);
    }

    public function btn_add_application()
    {
        if (in_array('Create Application', session('user_permission')['Application'])) {
            $this->redirect(route('sale.list', 'application?action=create'));
        } else {
            $this->dispatch("alert.message", [
                'type' => 'warning',
                'message' => __("Access Denied! You don't have permission to access this function. Request access from your administrator")
            ]);
        }
    }

    public function btn_edit_application($application_id)
    {
        if (in_array('Edit Application', session('user_permission')['Application'])) {
            $this->redirect(route('sale.list', 'application?action=update&application_id=' . $application_id));
        } else {
            $this->dispatch("alert.message", [
                'type' => 'warning',
                'message' => __("Access Denied! You don't have permission to access this function. Request access from your administrator")
            ]);
        }
    }
    public function btn_preview_application($application_id)
    {
        if (in_array('Preview Application', session('user_permission')['Application'])) {
            $this->redirect(route('sale.list', 'application?action=view&application_id=' . $application_id), navigate: true);
        } else {
            $this->dispatch("alert.message", [
                'type' => 'warning',
                'message' => __("Access Denied! You don't have permission to access this function. Request access from your administrator")
            ]);
        }
    }

    public function update_application_status($application_id)
    {
        if (in_array('Update Application Status', session('user_permission')['Application'])) {
            $this->dispatch('edit_application_status', $application_id);
            $this->dispatch('modal.openModal');
        } else {
            $this->dispatch("alert.message", [
                'type' => 'warning',
                'message' => __("Access Denied! You don't have permission to access this function. Request access from your administrator")
            ]);
        }
    }

    public function mount()
    {
        $this->start_date = now()->startOfMonth()->toDateString();
        $this->end_date = now()->endOfMonth()->toDateString();
        $this->getShops = DB::table('shops')
            ->join('applications', 'shops.id', '=', 'applications.shop_id')
            ->select('shops.*', 'shop_id')
            ->distinct()
            ->get();
        $this->getCities = DB::table('cities')
            ->join('addresss', 'addresss.city_id', '=', 'cities.id')
            ->whereNotNull('addresss.application_id')
            ->select("cities.*")
            ->groupBy('cities.id')
            ->get();
        $this->getpositions = DB::table('positions')
            ->join('agencies', 'agencies.position_id', '=', 'positions.id')
            ->join('applications', 'applications.agency_id', '=', 'agencies.id')
            ->select('positions.*')
            ->groupBy('positions.id')
            ->get();
    }

    public function onFilterStatus($status)
    {
        $this->filter_by_status = $status;
        $this->render();
    }

    public function import_application()
    {
        $this->redirect(route('sale.list', 'application?action=import'));
    }
}
