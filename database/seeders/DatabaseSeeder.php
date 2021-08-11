<?php

namespace Database\Seeders;

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
            RoleSeeder::class,
            PotentialitySeeder::class,
            CompanyPurchaseSeeder::class,
            CompanyStatusSeeder::class,
            CompanyTypeSeeder::class,
            CitySeeder::class,
            UserSeeder::class,
            TaskStatusSeeder::class,
        ]);

    }
}
