<?php

namespace Database\Seeders;

use App\Models\Position;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jsonPosition = [
            [
                'name' => 'Managing Partner',
                'abbreviation' => 'MP',
                'code' => '1',
                'language' => ['lang' => 'kh', 'name' => "ដៃគូសហការប្រតិបត្តិ"],
                'description' => 'Managing Partner for every staff working progress'
            ], [
                'name' => 'Business Director',
                'abbreviation' => 'BD',
                'code' => '01',
                'language' => ['lang' => 'kh', 'name' => "នាយកអាជីវកម្ម"],
                'description' => 'Business Director for every staff working progress'
            ], [
                'name' => 'Business Manager',
                'abbreviation' => 'BM',
                'code' => '001',
                'language' => ['lang' => 'kh', 'name' => "នាយកគ្រប់គ្រងក្រុមភ្នាក់ងារប្រឹក្សាបង់រំលស់"],
                'description' => ''
            ], [
                'name' => 'Customer Advisor',
                'abbreviation' => 'CA',
                'code' => '0001',
                'language' => ['lang' => 'kh', 'name' => "ប្រធានក្រុមគ្រប់គ្រងភ្នាក់ងារប្រឹក្សាបង់រំលស់"],
                'description' => 'Customer Advisor'
            ], [
                'name' => 'Lease Consultant',
                'abbreviation' => 'LC',
                'code' => '00001',
                'language' => ['lang' => 'kh', 'name' => "ភ្នាក់ងារប្រឹក្សាបង់រំលស់"],
                'description' => 'Lease Customer'
            ]
        ];
        foreach ($jsonPosition as $item) {
            DB::table('positions')->insert([
                'name' => $item['name'],
                'abbreviation' => $item['abbreviation'],
                'code'  => $item['code'],
                'languages' => json_encode($item['language'], JSON_UNESCAPED_UNICODE),
                'description' => $item['description'],
                'status' => true,
            ]);
        }
    }
}
