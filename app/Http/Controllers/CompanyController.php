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
    public $templateData = [];

    public function __construct()
    {
        $this->templateData['companyTypes'] = CompanyType::all();
        $this->templateData['companyPurchases'] = CompanyPurchase::all();
        $this->templateData['companyStatuses'] = CompanyStatus::all();
        $this->templateData['companyPotentialities'] = Potentiality::all();
        $this->templateData['citiesList'] = City::all();
    }

    public function index()
    {
        $this->templateData['companies'] = Auth::user()->companies;

        return view('company.index', $this->templateData);
    }

    /**
     * Проверка возможности добавления компании пользователю
     * ---
     * Параметры: объект пользователь и ИНН компании
     * ---
     * Возвращает JSON строку:
     * company false - можно добавить компанию пользователю;
     * company [ssn, name] - компания уже добавлена в систему.
     */
    public function check(Request $request)
    {
        $company = Company::where('ssn', $request->input('ssn'))
            ->where('company_status_id', '<>', 5)->firstOr(['id', 'name', 'ssn'], function () {
                return false;
            });

        if($company && ($company->user_id == $request->user()->id)) {
            $company = array_merge(
                $company->toArray(),
                ['url' => route('companies.show', ['company' => $company])]
            );
        }

        return response()->json([
            'company' => $company
        ], 200);
    }

    public function create()
    {
        return view('company.create', $this->templateData);
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

    public function show(Company $company)
    {
        $this->templateData['company'] = $company;

        return view('company.show', $this->templateData);
    }

    public function edit(Company $company)
    {
        $this->templateData['company'] = $company;

        return view('company.edit', $this->templateData);
    }

    public function update(Request $request, Company $company)
    {

    }

    public function destroy($id)
    {
        //
    }
}
