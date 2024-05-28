<?php

namespace Database\Seeders;

use App\Models\Position;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AgencySettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'commission_fee' => 50,
                'period_expiration' => 30,
                "override_fee" => 5
            ]
        ];
        foreach ($data as $item) {
            DB::table('agency_settings')->insert([
                'commission_fee' => $item['commission_fee'],
                'period_expiration' => $item['period_expiration'],
                'override_fee' => 5,
                'status' => true,
            ]);
        }
    }
}
