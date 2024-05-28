<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OccupationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jsonOccupation = [
            [
                'name' => 'Teacher',
                'language' => ['lang' => 'kh', 'name' => "គ្រូបង្រៀន"],
                'description' => 'staff working on private company'
            ], [
                'name' => 'NGO staff',
                'language' => ['lang' => 'kh', 'name' => "បុគ្គលិកអង្គការ"],
                'description' => 'staff working on private company'
            ], [
                'name' => 'Housewife',
                'language' => ['lang' => 'kh', 'name' => "មេផ្ទះ"],
                'description' => 'staff working on private company'
            ], [
                'name' => 'Farmers & Fishermen',
                'language' => ['lang' => 'kh', 'name' => "កសិករ & អ្នកនេសាទ"],
                'description' => 'staff working on private company'
            ], [
                'name' => 'Small or medium business owners',
                'language' => ['lang' => 'kh', 'name' => "ជាង / កម្មករ / ពលករ / បុគ្គលិកហាង"],
                'description' => 'staff working on private company'
            ], [
                'name' => 'Civil servants',
                'language' => ['lang' => 'kh', 'name' => "មន្ត្រីរាជការ"],
                'description' => 'staff working on private company'
            ], [
                'name' => 'Real Estate Agent',
                'language' => ['lang' => 'kh', 'name' => "ភ្នាក់ងារលក់អចលទ្រព្យ"],
                'description' => 'staff working on private company'
            ], [
                'name' => 'Bank or micro-finance staff',
                'language' => ['lang' => 'kh', 'name' => "បុគ្គលិកធនាគារ ឬមីក្រូ"],
                'description' => 'staff working on private company'
            ], [
                'name' => 'Insurance company staff',
                'language' => ['lang' => 'kh', 'name' => "បុគ្គលិកក្រុមហ៊ុនធានារ៉ាប់រង"],
                'description' => 'staff working on private company'
            ], [
                'name' => 'Insurance Sales Agent',
                'language' => ['lang' => 'kh', 'name' => "ភ្នាក់ងារលក់ធានារ៉ាប់រង"],
                'description' => 'staff working on private company'
            ], [
                'name' => 'Company staff',
                'language' => ['lang' => 'kh', 'name' => "បុគ្គលិកក្រុមហ៊ុន"],
                'description' => 'staff working on private company'
            ], [
                'name' => 'Students',
                'language' => ['lang' => 'kh', 'name' => "និស្សិត"],
                'description' => 'staff working on private company'
            ], [
                'name' => 'Other',
                'language' => ['lang' => 'kh', 'name' => "ផ្សេងៗ"],
                'description' => 'staff working on private company'
            ]
        ];
        foreach ($jsonOccupation as $item) {
            DB::table('occupations')->insert([
                'name' => $item['name'],
                'languages' => json_encode($item['language'], JSON_UNESCAPED_UNICODE),
                'description' => $item['description'],
                'status' => true,
            ]);
        }
    }
}
