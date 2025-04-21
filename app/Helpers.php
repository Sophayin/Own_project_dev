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
