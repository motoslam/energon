<?php

namespace App\Http\Controllers\Json;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    /** Поиск города по FiasId */
    public function find(Request $request)
    {
        $fias_id = $request->get('fias_id');
        $city = City::whereFiasId($fias_id)->firstOr(function(){
            return [];
        });

        return response()->json([
            'status' => !empty($city),
            'data' => $city
        ], 200);
    }
}
