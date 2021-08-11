<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insertOrIgnore([
            [
                'name' => 'Аккаунт разработчика',
                'email' => 'motoslam@mail.ru',
                'password' => Hash::make('password')
            ], [
                'name' => 'Андрей',
                'email' => 'nefyodov@yandex.ru',
                'password' => Hash::make('password')
            ], [
                'name' => 'Александр',
                'email' => 'alex_suschin@mail.ru',
                'password' => Hash::make('password')
            ], [
                'name' => 'Александр',
                'email' => 'alex_suschin@mail.ru',
                'password' => Hash::make('password')
            ]
        ]);
    }
}
