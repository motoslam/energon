<?php

namespace App\Http\Controllers\Json;

use App\Models\CompanyStatus as Status;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CompanyStatusController extends Controller
{
    public function index()
    {
        $statuses = Status::all()->except(5);

        return response()->json([
            'status' => true,
            'count' => $statuses->count(),
            'data' => $statuses
        ], 200);
    }
}
