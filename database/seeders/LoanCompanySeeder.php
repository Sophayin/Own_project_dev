<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LoanCompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $jsonRole = [
            [
                'name' => 'Bamboo Finance Plc',
                'language' => ['lang' => 'kh', 'name' => "បាប់ប៊ូ មីក្រូ ហិរញ្ញវត្ថុ ភី អិល ស៊ី"],
                'description' => '',
                'status' => true,
            ], [
                'name' => 'Trop Khnhom PLC',
                'language' => ['lang' => 'kh', 'name' => "ទ្រព្យ ខ្ញុំ​ ភី អិល ស៊ី"],
                'description' => '',
                'status' => true,
            ], [
                'name' => 'Pawn Shope 168  Co.,Ltd',
                'language' => ['lang' => 'kh', 'name' => "ភ័ណ្ឌ សប ១៦៨ ខូ. អិល ធី ឌី"],
                'description' => '',
                'status' => true,
            ]
        ];
        foreach ($jsonRole as $item) {
            DB::table('loan_companies')->insert([
                'name' => $item['name'],
                'languages' => json_encode($item['language'], JSON_UNESCAPED_UNICODE),
                'status' => true
            ]);
        }
    }
}
