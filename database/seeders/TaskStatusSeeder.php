<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaskStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('task_statuses')->insertOrIgnore([
            ['id' => 1, 'name' => 'Новая'],
            ['id' => 2, 'name' => 'В работе'],
            ['id' => 3, 'name' => 'Завершена'],
            ['id' => 4, 'name' => 'Отменена'],
            ['id' => 5, 'name' => 'Ожидает проверки'],
        ]);
    }
}
