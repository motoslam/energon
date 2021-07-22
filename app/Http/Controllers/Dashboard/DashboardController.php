<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\CompanyStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __invoke(Request $request)
    {
        $companyStatuses = CompanyStatus::all();

        $companies = Auth::user()->companies;

        return view('dashboard', compact(
            'companies', 'companyStatuses'
        ));
    }
}
