<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyCreateRequest;
use App\Models\CompanyAwait;
use Illuminate\Http\Request;
use App\Models\City;
use App\Models\Company;
use App\Models\CompanyPurchase;
use App\Models\CompanyStatus;
use App\Models\CompanyType;
use App\Models\Potentiality;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{
    public function index()
    {
        //
    }

    public function check(Request $request)
    {
        $company = Company::where('ssn', $request->input('ssn'))->firstOr(['*'], function () {
            return false;
        });

        if ($request->ajax()) {

            $ajaxResult = response()->json([
                'status' => true
            ], 200);

            if ($company) {
                if ($company->user == Auth::user()) {
                    $ajaxResult = response()->json([
                        'status' => false,
                        'message' => 'Организация ' . $company->name . ' уже есть в вашем списке'
                    ], 200);
                } else {
                    $ajaxResult = response()->json([
                        'status' => false,
                        'confirmButton' => true,
                        'message' => 'Организация ' . $company->name . ' уже добавлена другим менеджером. Продолжить?'
                    ], 200);
                }
            }
            return $ajaxResult;
        } else {
            return $company;
        }
    }

    public function create()
    {
        $data['companyTypes'] = CompanyType::all();
        $data['companyPurchases'] = CompanyPurchase::all();
        $data['companyStatuses'] = CompanyStatus::all();
        $data['companyPotentialities'] = Potentiality::all();
        $data['citiesList'] = City::all();
        return view('company.create', $data);
    }

    public function store(CompanyCreateRequest $request)
    {
        // TODO: Компания может быть softDELETE
        // тогда восстанавливаем вместе со всеми
        // данными при создании. Удалять компании
        // может админ? зачем?

        $newCompany = Company::firstOrNew([
            'company_type_id' => $request->input('company_type'),
            'company_status_id' => $request->input('company_status'),
            'company_purchase_id' => $request->input('company_purchase'),
            'potentiality_id' => $request->input('company_potentiality'),
            'city_id' => $request->input('city'),
            'name' => $request->input('name'),
            'legal' => $request->input('legal'),
            'ssn' => $request->input('ssn'),
            'description' => $request->input('description'),
            'address' => $request->input('address')
        ]);

        if($newCompany->user) {

            if($newCompany->user != Auth::user()) {

                CompanyAwait::create([
                    'company_id' => $newCompany->id,
                    'user_id' => Auth::user()->id,
                    'status' => 0
                ]);

            } else {

                return redirect()->back()->withErrors([
                    'ssn' => 'Данная организация уже добавлена в ваш список контрагентов'
                ]);

            }

        }

        $newCompany->user_id = $request->user()->id;

        $newCompany->save();

        return redirect()->route('companies.show', ['company' => $newCompany]);
    }

    public function show($id)
    {
        $company = Company::findOrFail($id);

        $companyStatuses = CompanyStatus::all();
        $companyPotentialities = Potentiality::all();

        return view('company.show', compact(
            'company',
            'companyStatuses',
            'companyPotentialities'
        ));
    }

    public function edit($id)
    {
        $company = Company::findOrFail($id);

        return view('company.edit');
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
