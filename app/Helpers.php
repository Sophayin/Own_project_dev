<?php

use App\Models\Agency;
use App\Models\AgencyHistory;
use App\Models\AgencySetting;
use App\Models\AwardTarget;
use App\Models\Notification;
use App\Models\Role;
use App\Models\TransactionLog;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

//$khNUMTxt = array('', 'មួយ', 'ពីរ', 'បី', 'បួន', 'ប្រាំ');
//$twoLetter = array('', 'ដប់', 'ម្ភៃ', 'សាមសិប', 'សែសិប', 'ហាសិប', 'ហុកសិប', 'ចិតសិប', 'ប៉ែតសិប', 'កៅសិប');
//$khNUMLev = array('', '', '', 'រយ', 'ពាន់', 'មឿន', 'សែន', 'លាន');
//$khnum = array('០', '១', '២', '៣', '៤', '៥', '៦', '៧', '៨', '៩');

if (!function_exists('get_translation')) {
    function get_translation($item)
    {
        if (App::getLocale('locale') == 'en') {
            return $item->name;
        } else {
            $lang = json_decode($item->languages, true);
            return $lang['name'];
        }
    }
}

if (!function_exists('staff_profile')) {
    function staff_profile($file_name)
    {
        if ($file_name == null) {
            return asset('/assets/icon/profile-gray.png');
        } else {
            return asset($file_name);
        }
    }
}

//{{ Today()->diffInDays(Carbon\Carbon::parse($agency->registered_date)) }}
//{{(Today()->diffInDays(Carbon\Carbon::parse($agency->registered_date)) <= 1 ? __('Day'): __('Days'))}}

if (!function_exists('check_user_exist')) {
    function check_user_exist($column, $value)
    {
        return User::where($column, $value)->first();
    }
}

if (!function_exists('check_role_name_exist')) {
    function check_role_name_exist($column, $value)
    {
        return Role::where($column, $value)->first();
    }
}

if (!function_exists('get_agency_status')) {
    function get_agency_status($status = null)
    {
        $statuss = [
            [
                'label' => "Active",
                'id'    => 1
            ], [
                'label' => 'Probation',
                'id'    => 2
            ], [
                'label' => 'Pending',
                'id'    => 3
            ], [
                'label' => 'Inactive',
                'id'    => 4
            ], [
                'label' => 'Terminate',
                'id'    => 6
            ]
        ];
        if ($status != '') {
            return array_values(array_filter($statuss, function ($element) use ($status) {
                if ($element['id'] === $status) {
                    return $element;
                }
            }))[0];
        } else {
            return $statuss;
        }
    }
}
if (!function_exists('get_application_status')) {
    function get_application_status($status = null)
    {
        $statuss = [
            [
                'label' => 'Rejected',
                'id' => 0
            ], [
                'label' => 'Approved',
                'id' => 2
            ], [
                'label' => 'Follow up',
                'id' => 1
            ]
        ];

        if ($status != '') {
            return array_values(array_filter($statuss, function ($element) use ($status) {
                if ($element['id'] == $status) {
                    return $element;
                }
            }))[0];
        } else {
            return $statuss;
        }
    }
}

if (!function_exists('get_award')) {
    function get_award($total_sale, $total_recruit, $position_id)
    {
        $agency_award = AwardTarget::where('position_id', $position_id)
            ->where('target_sale', '<=', $total_sale)
            ->where('target_recruit', '<=', $total_recruit)
            ->get();
        $reward = '';
        if ($position_id == 5) {
            if ($total_sale >= 3 && $total_recruit >= 3)
                return $reward = "Super LC";
        } else {
            $reward = '';
            foreach ($agency_award as $award) {
                if ($total_sale >= $award->target_sale && $total_recruit >= $award->target_recruit) {
                    $reward = $award->award->name ?? '';
                }
            }
            return $reward;
        }
    }
}
if (!function_exists('create_transaction_log')) {
    function create_transaction_log($action, $type, $desc, $reference)
    {
        $action_log = new TransactionLog();
        $action_log->action = $action;
        $action_log->type = $type;
        $action_log->description = $desc;
        $action_log->reference = $reference;
        $action_log->created_by_user = Auth::user()->name;
        $action_log->user_id = Auth::id();
        $action_log->save();
    }
}
if (!function_exists('generate_agency_code')) {
    function generate_agency_code($position_id)
    {
        $positions = [
            1 => ['prefix' => 'MP', 'padding' => 1],
            2 => ['prefix' => 'BD', 'padding' => 2],
            3 => ['prefix' => 'BM', 'padding' => 3],
            4 => ['prefix' => 'CA', 'padding' => 4],
            5 => ['prefix' => 'LC', 'padding' => 5],
        ];
        // return $position_id;
        $positionData = $positions[$position_id];
        $latestAgencyCode = Agency::where('position_id', $position_id)->max('code');
        $latestPromoteCode = AgencyHistory::where('position_id', $position_id)->max('agency_code');
        $latestCode = max($latestAgencyCode, $latestPromoteCode);
        if ($latestCode) {
            preg_match('/\d+/', $latestCode, $matches);
            $currentNumber = (int)$matches[0] + 1;
        } else {
            $currentNumber = 1;
        }

        $newCode = $positionData['prefix'] . str_pad($currentNumber, $positionData['padding'], '0', STR_PAD_LEFT);
        while (Agency::where('code', $newCode)->exists() || AgencyHistory::where('agency_code', $newCode)->exists()) {
            $currentNumber++;
            $newCode = $positionData['prefix'] . str_pad($currentNumber, $positionData['padding'], '0', STR_PAD_LEFT);
        }
        return $newCode;
    }
}

if (!function_exists('get_agency_leader_by_position')) {
    function get_agency_leader_by_position($position_id)
    {
        switch ($position_id) {
            case 1:
                return [1];
                break;
            case 2:
                return [1];
                break;
            case 3:
                return [1, 2];
                break;
            case 4:
                return [1, 2, 3];
                break;
            case 5:
                return [1, 2, 3, 4];
                break;
            default:
                return [];
                break;
        }
    }
}
