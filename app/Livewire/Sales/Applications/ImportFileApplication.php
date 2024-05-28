<?php

namespace App\Livewire\Sales\Applications;

use App\Exports\ExportApplicationFile;
use App\Imports\ImportApplicationFile;
use App\Models\Address;
use App\Models\AgencyHistory;
use App\Models\Application;
use App\Models\Loan_company;
use App\Models\Product;
use App\Models\Shop;
use App\Services\DownloadPdfService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

class ImportFileApplication extends Component
{
    use WithFileUploads;
    public $import_file;
    public $previewData = [];
    public $selectedRow = [];
    public $selectAll = [];
    public $code;
    public $positions, $occupations;
    public $checkbox_main = true;
    public $products, $shops, $MFI;

    public function render()
    {
        return view('livewire.sales.applications.import-file-application');
    }
    //--import excel file---
    public function importFile()
    {
        $this->selectedRow = [];
        if ($this->import_file) {
            $file = $this->import_file;
            $this->previewData = Excel::toCollection(new ImportApplicationFile, $file)->first()->toArray();
            $this->check_box_row(true);
        }
    }
    //--save file into database---
    public function saveApplicationFile()
    {
        $get_selected_row = array_filter($this->selectedRow, function ($item) {
            return $item == true ? $item : null;
        });
        $get_selected_data_row =  array_filter($this->previewData, function ($item) use ($get_selected_row) {
            if (in_array($item['id'], array_keys($get_selected_row))) {
                return $item;
            }
        });
        $application_imported = [];
        $application_unimported = [];
        foreach ($get_selected_data_row as $item) {
            if (AgencyHistory::where('agency_code', $item['agency_code'])->exists()) {
                if (Product::where('id', $item['product_id'])->exists()) {
                    $agency_code = AgencyHistory::where('agency_code', $item['agency_code'])->first();
                    $product = Product::where('id', $item['product_id'])->first();
                    $application = new Create();
                    $newApplicationCode = $application->generate_application_code();
                    $application = new Application();
                    $application->code = $newApplicationCode;
                    $application->agency_id = $agency_code->agency_id ?? null;
                    $application->agency_code = $item['agency_code'];
                    $application->agency_leader_code = $agency_code->agency->parent->code ?? null;
                    $application->client_name = $item['client_name'];
                    $application->client_name_translate = $item['client_name_translate'];
                    $application->gender = $item['gender'];
                    $application->khmer_identity_card = $item['khmer_identity_card'];
                    $application->phone = $item['phone'];
                    $application->occupation_id = $item['occupation_id'];
                    $application->income = $item['income'];
                    $application->guarantor_name = $item['guarantor_name'];
                    $application->guarantor_name_translate = $item['guarantor_name_translate'];
                    $application->guarantor_phone = $item['guarantor_phone'];
                    $application->shop_id = $item['shop_id'];
                    $application->product_id = $item['product_id'] ?? null;
                    $application->product_name = $product->title ?? null;
                    $application->condition = $product->condition ?? null;
                    $application->product_price = $item['product_price'] == null ? $product->price : $item['product_price'];
                    $application->respond_by = $item['respond_by'];
                    $application->loan_company_id = $item['loan_company_id'];
                    $application->status = $item['status'];
                    $application->is_payroll = $item['is_payroll'] == 'paid' ? true : false;
                    $application->created_by =  Auth::user()->name;
                    $registered_date = $item['register_year'] . '-' . $item['register_month'] . "-" . $item['register_day'];
                    $application->created_at = date('Y-m-d h:i:s', strtotime($registered_date));

                    if ($application->save()) {
                        $address = new Address();
                        $address->application_id = $application->id;
                        $address->city_id = $item['city_id'];
                        $address->district_id = $item['district_id'];
                        $address->commune_id = $item['commune_id'];
                        $address->village_id = $item['village_id'];
                        $address->house_no = $item['house_no'];
                        $address->street_no = $item['street_no'];
                        $address->save();
                    }
                    $application_imported[] = $item['client_name'];
                }
            } else {
                $application_unimported[] = $item['client_name'];
            }
        }
        return back()->with([
            'status' => 'success',
            'imported' => $application_imported,
            'unimported' => $application_unimported,
        ]);
    }
    public function SelectAll()
    {
        $check_true = false;
        if ($this->checkbox_main)
            $check_true = true;

        $this->check_box_row($check_true);
    }

    public function check_box_row($check_true)
    {
        foreach ($this->previewData as $key => $item) {
            $this->selectedRow[$item['id']] = $check_true;
        }
    }

    public function downlaodExcelFile()
    {
        return Excel::download(new ExportApplicationFile, 'sample_application_data.xlsx', \Maatwebsite\Excel\Excel::XLSX);
    }

    public function productList()
    {
        $this->products = Product::all();
    }

    public function downloadProduct()
    {
        $this->productList();
        $data = [
            'products' => $this->products,
        ];
        $pdf =  new DownloadPdfService('Product.pdf', 'exports.pdf.product-export', $data);
        return $pdf->download();
    }

    public function shopList()
    {
        $this->shops = Shop::all();
    }

    public function downloadShop()
    {
        $this->shopList();
        $data = [
            'shops' => $this->shops,
        ];
        $pdf =  new DownloadPdfService('Shop.pdf', 'exports.pdf.shop-export', $data);
        return $pdf->download();
    }

    public function MFIList()
    {
        $this->MFI = Loan_company::all();
    }

    public function downloadMFI()
    {
        $this->MFIList();
        $data = [
            'MFI' => $this->MFI,
        ];
        $pdf = new DownloadPdfService('MFI.pdf', 'exports.pdf.MFI', $data);
        return $pdf->download();
    }
}
