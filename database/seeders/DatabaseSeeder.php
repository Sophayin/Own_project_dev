<?php

namespace Database\Seeders;


use App\Models\Award;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            //RoleSeeder::class,
            DepartmentSeeder::class,
            PositionSeeder::class,
            UserSeeder::class,
            ShopSeeder::class,
            LoanCompanySeeder::class,
            OccupationSeeder::class,
            CountrySeeder::class,
            ProductSeeder::class,
            ReasonSeeder::class,
        ]);
    }
}
