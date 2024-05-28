<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReasonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jsonReason = [
            [
                'name' => 'Multiple Bank lending',
                'language' => ['lang' => 'kh', 'name' => "កម្ចីច្រើនធនាគារ"],
                'type' => 'application',
                'description' => 'Client is stucking with many bank lending currently',
                'action' => 'reject'
            ], [
                'name' => 'Low Income',
                'language' => ['lang' => 'kh', 'name' => "ប្រាក់ចំណូលទាប"],
                'type' => 'application',
                'description' => 'it is high over their income that cannot be able to pay back.',
                'action' => 'reject'
            ], [
                'name' => 'Bad CBC Credit',
                'language' => ['lang' => 'kh', 'name' => "ប្រវត្តិឥណទានមិនល្អ"],
                'type' => 'application',
                'description' => 'This client always pays late to MFI, and sometimes not pay at all.',
                'action' => 'reject'
            ], [
                'name' => 'No Warranty Property',
                'language' => ['lang' => 'kh', 'name' => "មិនមានទ្រព្យបញ្ចាំ"],
                'type' => 'application',
                'description' => 'He lives in rent room, has no property for warranty on this loan, high risk.',
                'action' => 'reject'
            ], [
                'name' => 'Insufficient Documents',
                'language' => ['lang' => 'kh', 'name' => "ខ្វះឯកសារ"],
                'type' => 'application',
                'description' => 'This client look good, but we are not provided enough documents for process this loan.',
                'action' => 'reject'
            ]
        ];
        foreach ($jsonReason  as $reason) {
            DB::table('reasons')->insert([
                'name' => $reason['name'],
                'languages' => json_encode($reason['language'], JSON_UNESCAPED_UNICODE),
                'type'  => $reason['type'],
                'description' => $reason['description'],
                'action' => $reason['action'],
            ]);
        }
    }
}
