<?php

namespace App\Imports;

use App\Models\Agency;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ImportFileExcel implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return $row;
        //        return new Agency([
        //            'id' => $row['id'] ?? '',
        //            'current_code' => $row['current_code'] ?? null,
        //            'agency_id' => $row['agency_id'] ?? null,
        //            'current_leader_code' => $row['current_leader_code'] ?? null,
        //            'referrer_code' => $row['referrer_code'] ?? null,
        //            'khmer_identity_card' => $row['khmer_identity_card'] ?? null,
        //            'agency_profile' => $row['agency_profile'] ?? null,
        //            'full_name' => $row['full_name'] ?? null,
        //            'full_name_translate' => $row['full_name_khmer'] ?? null,
        //            'phone' => $row['phone'] ?? null,
        //            'phone_telegram' => $row['phone_telegram'] ?? null,
        //            'gender' => $row['gender'] ?? null,
        //            'age' => $row['age'] ?? null,
        //            'position_id' => $row['position_id'] ?? null,
        //            'occupation_id' => $row['occupation_id'] ?? null,
        //            'income' => $row['income'] ?? null,
        //            'status' => $row['status'],
        //            'bank_aba' => $row['bank_aba'] ?? null,
        //            'bank_acleda' => $row['bank_acleda'] ?? null,
        //            'date_of_birth' => $row['date_of_birth']->format('Y-m-d') ?? null,
        //            'remark' => $row['remark'] ?? null,
        //            'registered_date' => $row['registered_date']->format('Y-m-d') ?? null,
        //            'lc_created_at' => $row['lc_created_at']->format('Y-m-d'), // json_encode($row['lc_created_at'], JSON_UNESCAPED_UNICODE) ?? null,
        //            'ca_created_at' => $row['ca_created_at']->format('Y-m-d') ?? null,
        //
        //            'bm_created_at' => $row['bm_created_at']->format('Y-m-d') ?? null,
        //            'bd_created_at' => $row['bd_created_at']->format('Y-m-d') ?? null
        //        ]);
    }
}
