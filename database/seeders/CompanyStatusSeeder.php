<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanyStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('company_statuses')->insertOrIgnore([
            ['id' => 1, 'name' => 'Проработка', 'short_name' => 'Проработка'],
            ['id' => 2, 'name' => 'Действующий - разовый', 'short_name' => 'Действ. (Р)'],
            ['id' => 3, 'name' => 'Действующий – постоянный', 'short_name' => 'Действ. (П)'],
            ['id' => 4, 'name' => 'Закрыт', 'short_name' => 'Закрыт'],
            ['id' => 5, 'name' => 'Свободный', 'short_name' => 'Свободный']
        ]);
    }
}
