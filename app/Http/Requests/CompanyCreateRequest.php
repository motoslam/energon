<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Company;
use Illuminate\Support\Facades\Auth;

class CompanyCreateRequest extends FormRequest
{
    protected $stopOnFirstFailure = true;

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'ssn' => ['required'],
            'name' => ['required'],
            'city' => ['required', 'exists:cities,id'],
            'company_type' => ['sometimes', 'required', 'exists:company_types,id'],
            'company_purchase' => ['sometimes', 'required', 'exists:company_purchases,id'],
            'company_status' => ['sometimes', 'required', 'exists:company_statuses,id'],
            'company_potentiality' => ['sometimes', 'required', 'exists:potentialities,id'],
        ];
    }

    public function messages()
    {
        return [
            'ssn.required' => 'Ошибка при добавлении контрагента: Организация не найдена',
            'name.required' => 'Ошибка при добавлении контрагента: Организация без имени',
            'city.required' => 'Ошибка при добавлении контрагента: Указанный город не найден',
            'company_type.exists' => 'Тип контрагента не зарегистрирован',
            'company_purchase.exists' => 'Тип закупки не зарегистрирован',
            'company_status.exists' => 'Статус контрагента не зарегистрирован',
            'company_potentiality.exists' => 'Потенциал не зарегистрирован',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'название организации',
            'ssn' => 'ИНН',
            'city' => 'ИНН',
            'company_type' => 'тип контрагента',
            'company_purchase' => 'тип закупки',
            'company_status' => 'статус контрагента',
            'company_potentiality' => 'потенциал',
        ];
    }

    /*public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $newCompanyData = $validator->validated();
            $newCompany = Company::where('ssn', $newCompanyData['ssn'])->firstOr(['*'], function () {
                return false;
            });
            if($newCompany) {
                if($newCompany->user == $this->user()) {
                    $validator->errors()->add('duplicate', 'Duplicated company for user');
                } elseif(!empty($newCompany->user)) {
                    $validator->errors()->add('duplicate', 'Duplicated company for another user');
                }
            }
        });
    }*/
}
