<?php

namespace Database\Seeders;

use App\Models\Position;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AwardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jsonAward = [
            [
                'name' => 'Mini Target',
                'description' => '',
                'color_code' => ''
            ],
            [
                'name' => 'Monthly Target',
                'description' => '',
                'color_code' => ''
            ],
            [
                'name' => 'Bronze',
                'description' => '',
                'color_code' => '#CD7F32'
            ], [
                'name' => 'Silver',
                'description' => '',
                'color_code' => '#C0C0C0'
            ], [
                'name' => 'Gold',
                'description' => '',
                'color_code' => '#D4AF37'
            ]
        ];
        foreach ($jsonAward as $item) {
            DB::table('awards')->insert([
                'name' => $item['name'],
                'description' => $item['description'],
                'status' => true,
            ]);
        }
    }
}
