<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jsonProduct = [
            [
                'code' => 'D023',
                'title' => 'Honda Dream black 023',
                'year_of_manufacture' => '2023',
                'condition' => 'New',
                'price' => '2250',
            ], [
                'code' => 'P023',
                'title' => 'Honda PCX 023',
                'year_of_manufacture' => '2023',
                'condition' => 'New',
                'price' => '4250',
            ], [
                'code' => 'A023',
                'title' => 'Honda ADV 023',
                'year_of_manufacture' => '2023',
                'condition' => 'New',
                'price' => '5150',
            ], [
                'code' => 'B023',
                'title' => 'Honda BEAT 023',
                'year_of_manufacture' => '2023',
                'condition' => 'New',
                'price' => '2150',
            ], [
                'code' => 'W023',
                'title' => 'Honda WAVE 023',
                'year_of_manufacture' => '2023',
                'condition' => 'New',
                'price' => '1650',
            ], [
                'code' => 'S023',
                'title' => 'Honda Scoopy 023',
                'year_of_manufacture' => '2023',
                'condition' => 'New',
                'price' => '2850',
            ]
        ];
        foreach ($jsonProduct as $item) {
            DB::table('products')->insert([
                'code' => $item['code'],
                'title' => $item['title'],
                'year_of_manufacture' => $item['year_of_manufacture'],
                'condition' => $item['condition'],
                'price' => $item['price']
            ]);
        }
    }
}
