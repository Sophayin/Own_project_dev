<?php

namespace App\Livewire\HRM;

use App\Exports\PayrollExport;
use App\Models\PayrollDetail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class PayrollPreview extends Component
{
    public function render()
    {
        return view('livewire.h-r-m.payroll-preview')->layout('layouts.frontend')->title("Payroll Preview");
    }

    public $payrolls;
    public $payroll_ids;
    public $position_name;

    public function mount()
    {
        $this->payroll_ids = Session::get('payrolls');
        if (is_null($this->payroll_ids))
            return redirect()->to('/finance/payroll');
        $payrolls = PayrollDetail::whereIn('id', $this->payroll_ids)->get();
        $this->position_name = $payrolls->pluck('agency.position.abbreviation')->unique()->implode('/');

        $this->payrolls = $payrolls->groupBy(function ($detail) {
            return $detail->agency_id;
        })->map(function ($group) {
            return $this->calculateSales($group);
        });
    }

    private function calculateSales($details)
    {
        $firstSale = 0;
        $firstIncentive = 0;
        $firstSalary = 0;
        $firstCommission_fee = 0;
        $firstOverride_fee = 0;

        $secondSale = 0;
        $secondIncentive = 0;
        $secondSalary = 0;
        $secondCommission_fee = 0;
        $secondOverride_fee = 0;
        $totalPayroll = 0;

        $startFirstRange = Carbon::now()->subMonth()->startOfMonth()->addDays(20);
        $endFirstRange = Carbon::now()->startOfMonth()->addDays(5);
        $startSecondRange = Carbon::now()->startOfMonth()->addDays(5);
        $endSecondRange = Carbon::now()->startOfMonth()->addDays(20);
        //dd($startFirstRange);
        foreach ($details as $detail) {
            $createdAt = Carbon::parse($detail->created_at);

            if ($createdAt->between($startFirstRange, $endFirstRange) && $detail->total_sale != null) {
                $firstCommission_fee += $detail->commission_fee;
                $firstOverride_fee += $detail->override_fee;
            }

            if ($createdAt->between($startSecondRange, $endSecondRange) && $detail->total_sale != null) {
                $secondSale += $detail->total_sale;
                $secondIncentive += $detail->incentive;
                $secondSalary += $detail->salary;
                $secondCommission_fee += $detail->commission_fee;
                $secondOverride_fee += $detail->override_fee;
                $secondSale += $detail->total_sale;
                $totalPayroll += $detail->total_payroll += $detail->commission_fee;
            }
        }

        return [
            'details' => $details,
            'first_sale' => $firstSale,
            'first_incentive' => $firstIncentive,

            'second_sale' => $secondSale,
            'second_commiession_fee' => $secondCommission_fee,
            'second_override_fee' => $secondOverride_fee,
            'second_incentive' => $secondIncentive,
            "total_payroll" => $totalPayroll
        ];
    }

    public function download_pdf()
    {
        return Excel::download(new PayrollExport($this->payroll_ids), 'Payroll-' . Carbon::now() . '.pdf', \Maatwebsite\Excel\Excel::MPDF);
    }

    public function download_excel()
    {
        return Excel::download(new PayrollExport($this->payroll_ids), 'Payroll-' . Carbon::now() . '.xlsx', \Maatwebsite\Excel\Excel::XLSX);
    }
}
