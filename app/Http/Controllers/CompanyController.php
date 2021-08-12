<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyCreateRequest;
use App\Models\CompanyAwait;
use App\Models\Contact;
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
        $this->templateData['companyStatuses'] = CompanyStatus::allowed();
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
     * company [id, ssn, url] - компания уже добавлена в систему.
     */
    public function check(Request $request)
    {
        $company = Company::where('ssn', $request->input('ssn'))
            ->where('company_status_id', '<>', 5)->firstOr(['*'], function () {
                return false;
            });

        if ($company) {
            $company = $company->only('id', 'ssn', 'url');
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
            'ssn' => $request->input('ssn'),
        ]);

        if (!$newCompany->user) {

            $newCompany->user_id = Auth::user()->id;
            $newCompany->company_type_id = $request->input('company_type') ?? 1;
            $newCompany->company_status_id = $request->input('company_status') ?? 1;
            $newCompany->company_purchase_id = $request->input('company_purchase') ?? 1;
            $newCompany->potentiality_id = $request->input('company_potentiality') ?? 3;
            $newCompany->city_id = City::whereId($request->input('city'))->firstOr(['id'], function () {
                return 510;
            })->id;
            $newCompany->name = $request->input('name');
            $newCompany->legal = $request->input('legal');
            $newCompany->description = $request->input('description');
            $newCompany->address = $request->input('address');
            $newCompany->save();

        } else {

            if ($newCompany->user != Auth::user()) {

                CompanyAwait::create([
                    'company_id' => $newCompany->id,
                    'user_id' => Auth::user()->id,
                    'status' => 0,
                ]);

                return redirect()->route('companies.index')->with(
                    'success', 'Контрагент появится в списке, как только руководитель одобрит перенос.'
                );

            } else {

                return redirect()->route('companies.show', ['company' => $newCompany])->withErrors([
                    'ssn' => 'Организация уже была добавлена в список ваших контрагентов.'
                ]);

            }

        }

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
        $company->company_type_id = $request->input('company_type') ?? 1;
        $company->company_status_id = $request->input('company_status') ?? 1;
        $company->company_purchase_id = $request->input('company_purchase') ?? 1;
        $company->potentiality_id = $request->input('company_potentiality') ?? 3;
        $company->contract = $request->input('contract');
        $company->specification = $request->input('specification');
        $company->offer_number = $request->input('offer_number');
        $company->order_number = $request->input('order_number');
        $company->order_date = $request->input('order_date');
        $company->order_total = $request->input('order_total');
        $company->manager_bonus = $request->input('manager_bonus');
        $company->working_hours = $request->input('working_hours');
        $company->equipment = $request->input('equipment');
        $company->save();

        return redirect()->route('companies.show', ['company' => $company])->with([
            'success' => 'Изменения сохранены'
        ]);
    }

    public function tasks(Company $company)
    {
        $this->templateData['company'] = $company;

        return view('company.show', $this->templateData);
    }

    public function contacts(Company $company)
    {
        $this->templateData['company'] = $company;

        return view('company.show', $this->templateData);
    }

    public function destroy($id)
    {
        //
    }

    public function bundle(Company $company)
    {
        $this->templateData['company'] = $company;

        return view('company.bundle', $this->templateData);
    }
}
