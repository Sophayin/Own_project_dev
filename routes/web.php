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
use App\Livewire\Expends\DailyExpend;
use App\Livewire\Expends\DailyExpendList;
use App\Livewire\HRM\HRMList;
use App\Livewire\HRM\PayrollPreview;
use App\Livewire\Notification;
use App\Livewire\Other\Product\CreateProduct;
use App\Livewire\Other\Product\ProductList;
use App\Livewire\Other\Shop\ShopList;
use App\Livewire\OtherExpense\OtherExpenseList;
use App\Livewire\Report\Agency\DailySaleReport;
use App\Livewire\Report\Agency\RecruitReportByAgencyPosition;
use App\Livewire\Report\Agency\SaleReportByAgencyGroup;
use App\Livewire\Report\Agency\SaleReportByShop;
use App\Livewire\Report\Agency\TrainingReport;
use App\Livewire\Report\DailyExpenseReport;
use App\Livewire\Report\Finance\BusinessAllowenceIncentiveReport;
use App\Livewire\Report\Finance\SalaryReport;
use App\Livewire\Report\Finance\SaleCommissionReport;
use App\Livewire\Report\ManageReport;
use App\Livewire\Report\MonthlyExpenseReport;
use App\Livewire\Sales\Applications\ApplicationStatus;
use App\Livewire\Sales\Applications\Create as ApplicationsCreate;
use App\Livewire\Sales\Applications\Update as ApplicationsUpdate;
use App\Livewire\Sales\ManageSale;
use App\Livewire\Sales\Sale\Preview;
use App\Livewire\Setting\ExchangeRate;
use App\Livewire\Setting\ManageSetting;
use App\Livewire\TargetExpense\TargetExpenseList;
use App\Livewire\Users\ManageUser;
use App\Livewire\Users\Role\RoleApplyPermission;
use App\Livewire\Users\Staff\UserProfile;
use App\Models\TargetExpense;
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
Route::GET('/login', Login::class)->name('login');
Route::middleware('auth', 'route_permission')->group(function () {
  Route::GET('/user/role-apply-permission/{role_id}', RoleApplyPermission::class)->name('role.apply_permission');
  Route::GET('/', Dashboard::class)->name('dashboard');
  Route::GET('/user/{slug}', ManageUser::class)->name('user.list');
  Route::GET('/user/role-apply-permission/{role_id}', RoleApplyPermission::class)->name('role.apply_permission');
  Route::GET('/daily-expense', DailyExpendList::class)->name('target-expense');
  Route::GET('/other-expense', OtherExpenseList::class)->name('other-expense');
  Route::GET('/target-expense', TargetExpenseList::class)->name('target-expense');

  Route::GET('/report/{slug}', ManageReport::class)->name('report');
  Route::GET('/report/daily_expense-report', DailyExpenseReport::class)->name('daily-expense-report');
  Route::GET('/report/monthly-expense-report', MonthlyExpenseReport::class)->name('monthly-expense-report');
  Route::GET('/setting/{slug}', ManageSetting::class)->name('setting.language');
  Route::GET('/setting/exchange-rate', ExchangeRate::class)->name('setting.exchange-rate');
  Route::GET('/notification', Notification::class)->name('notification');
});
