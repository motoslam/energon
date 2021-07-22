<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PotentialitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('potentialities')->insertOrIgnore([
            ['id' => 1, 'name' => 'Крупный'],
            ['id' => 2, 'name' => 'Средний'],
            ['id' => 3, 'name' => 'Малый']
        ]);
    }
}
