<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Company;

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
            'name' => ['required'],
            'ssn' => ['required'],
            'city' => ['required', 'exists:cities,id'],
            'company_type' => ['required', 'exists:company_types,id'],
            'company_purchase' => ['required', 'exists:company_purchases,id'],
            'company_status' => ['required', 'exists:company_statuses,id'],
            'company_potentiality' => ['required', 'exists:potentialities,id'],
        ];
    }

    public function messages()
    {
        return [

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
