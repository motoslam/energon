<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanyPurchaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('company_purchases')->insertOrIgnore([
            ['id' => 1, 'name' => 'Внутренняя закупка'],
            ['id' => 2, 'name' => 'Закупка по 223-ФЗ'],
            ['id' => 3, 'name' => 'Коммерческие закупки на электронной площадке']
        ]);
    }
}
