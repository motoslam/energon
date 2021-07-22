<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Libraries\CatalogLibrary;

class CitySeeder extends Seeder
{
    public function run()
    {
        CatalogLibrary::update();
    }
}
