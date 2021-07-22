<?php

namespace App\Libraries;

use App\Imports\RegionImport;
use App\Imports\CityImport;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class CatalogLibrary
{

    /**
     * Обновляем каталоги городов и регионов
     */
    public static function update()
    {
        Excel::import(new RegionImport, 'region.csv');
        Excel::import(new CityImport, 'cities.csv');
    }
}
