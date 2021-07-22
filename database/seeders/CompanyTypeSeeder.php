<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanyTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('company_types')->insertOrIgnore([
            ['id' => 1, 'name' => 'Монтажная организация'],
            ['id' => 2, 'name' => 'Промышленное предприятие'],
            ['id' => 3, 'name' => 'Инвестиционный проект'],
            ['id' => 4, 'name' => 'АПК'],
            ['id' => 5, 'name' => 'Проектировщики'],
            ['id' => 6, 'name' => 'Сетевая компания'],
            ['id' => 7, 'name' => 'Строительная компания']
        ]);
    }
}
