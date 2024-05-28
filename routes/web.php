<?php

use App\Livewire\Agency\Create;
use App\Livewire\Agency\ManageAgency;
use App\Livewire\Agency\Register\AgencyRegister;
use App\Livewire\Agency\Structure\StructureView;
use App\Livewire\Agency\Suggestion\Demote;
use App\Livewire\Agency\Suggestion\DemoteList;
use App\Livewire\Agency\Suggestion\PromoteAgency;
use App\Livewire\Agency\Suggestion\SuggestionList;
use App\Livewire\Agency\Update;
use App\Livewire\Report\Finance\OverrideCommissionReport;
use App\Livewire\Sales\Applications\ViewApplication;
use App\Livewire\Auth\Login;
use App\Livewire\Dashboard;
use App\Livewire\HRM\HRMList;
use App\Livewire\HRM\PayrollPreview;
use App\Livewire\Notification;
use App\Livewire\Other\Product\CreateProduct;
use App\Livewire\Other\Product\ProductList;
use App\Livewire\Other\Shop\ShopList;
use App\Livewire\Report\Agency\DailySaleReport;
use App\Livewire\Report\Agency\RecruitReportByAgencyPosition;
use App\Livewire\Report\Agency\SaleReportByAgencyGroup;
use App\Livewire\Report\Agency\SaleReportByShop;
use App\Livewire\Report\Agency\TrainingReport;
use App\Livewire\Report\Finance\BusinessAllowenceIncentiveReport;
use App\Livewire\Report\Finance\SalaryReport;
use App\Livewire\Report\Finance\SaleCommissionReport;
use App\Livewire\Report\ManageReport;
use App\Livewire\Sales\Applications\ApplicationStatus;
use App\Livewire\Sales\Applications\Create as ApplicationsCreate;
use App\Livewire\Sales\Applications\Update as ApplicationsUpdate;
use App\Livewire\Sales\ManageSale;
use App\Livewire\Sales\Sale\Preview;
use App\Livewire\Setting\ExchangeRate;
use App\Livewire\Setting\ManageSetting;
use App\Livewire\Users\ManageUser;
use App\Livewire\Users\Role\RoleApplyPermission;
use App\Livewire\Users\Staff\UserProfile;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});

Route::GET('/user-profile/{id}', UserProfile::class)->name('user-profile');
Route::GET('/agency-register', AgencyRegister::class)->name('agency.register');
Route::GET('/login', Login::class)->name('login');
Route::middleware('auth', 'route_permission')->group(function () {

  Route::GET('/user/role-apply-permission/{role_id}', RoleApplyPermission::class)->name('role.apply_permission');
  Route::GET("/agency/structure/{agency_id}", StructureView::class)->name('structure.view');
  Route::GET("/agency/{slug}", ManageAgency::class)->name('agency.list');

  Route::GET("/agency/suggestion/list", SuggestionList::class)->name('suggestion.list');
  Route::GET("/agency/demote/list", DemoteList::class)->name('demote.list');
  Route::GET("/agency/suggestion/promote/{agency_id}", PromoteAgency::class)->name('suggestion.promote');
  Route::GET("/agency/suggestion/demote/{agency_id}", Demote::class)->name('suggestion.demote');

  Route::GET('/', Dashboard::class)->name('dashboard');
  Route::GET('/user/{slug}', ManageUser::class)->name('user.list');
  Route::GET('/user/role-apply-permission/{role_id}', RoleApplyPermission::class)->name('role.apply_permission');
  Route::GET("/agency-create", Create::class)->name('agency.create');
  Route::GET("/agency-update/{id}", Update::class)->name('agency.update');
  Route::GET('/sale/{slug}', ManageSale::class)->name('sale.list');
  Route::GET('/sale/application/create', ApplicationsCreate::class)->name('application.create');
  Route::POST('sale/applciation/create-status/{id}', ApplicationStatus::class)->name("application.create-status");
  Route::GET('/sale/application-update/{id}', ApplicationsUpdate::class)->name('application.update');
  Route::GET('/application-view/{id}', ViewApplication::class)->name('application-view');
  Route::get('sales/preview', Preview::class)->name('sale.preview');
  Route::GET('/finance/{slug}', HRMList::class)->name('hrm');

  Route::GET('/report/{slug}', ManageReport::class)->name('report');
  Route::GET('/report/agency/daily-sale-report', DailySaleReport::class)->name('report.daily-sale-report');
  Route::GET('/report/agency/sale-report-by-shop', SaleReportByShop::class)->name('report.sale-report-by-shop');
  Route::GET('/report/agency/sale-report-by-agency-group', SaleReportByAgencyGroup::class)->name('report.sale-report-by-agency-group');
  Route::GET('/report/agency/recruit-report-by-agency-position', RecruitReportByAgencyPosition::class)->name('report.recruit-report-by-agency-position');
  Route::GET('/report/agency/training-report', TrainingReport::class)->name('report.training-report');

  Route::get('/payroll/preview', PayrollPreview::class)->name('payroll.preview');

  Route::GET('/report/finance/sale-commission-report', SaleCommissionReport::class)->name('report-finance.sale-commission-report');
  Route::GET('/report/finance/override-commission-report', OverrideCommissionReport::class)->name('override-commission-report');
  Route::GET('/report/finance/salary-report', SalaryReport::class)->name('report-finance.salary-report');
  Route::GET('/report/finance/allowence-incentive-report', BusinessAllowenceIncentiveReport::class)->name('report-finance.incentive-report');

  Route::GET('/setting/{slug}', ManageSetting::class)->name('setting.language');
  Route::GET('/setting/exchange-rate', ExchangeRate::class)->name('setting.exchange-rate');

  Route::GET('/notification', Notification::class)->name('notification');
  Route::GET('/manage/shop', ShopList::class)->name('shop-list');
  Route::GET('/manage/product', ProductList::class)->name('product-list');
});
