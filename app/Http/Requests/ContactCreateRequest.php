<?php

namespace App\Http\Requests;

use App\Models\Company;
use Illuminate\Foundation\Http\FormRequest;

class ContactCreateRequest extends FormRequest
{

    public function authorize()
    {
        $company = Company::find($this->company);
        return ($company and $company->user_id = $this->user()->id);
    }

    public function rules()
    {
        return [
            'company' => ['required', 'exists:companies,id'],
            'name' => ['required']
        ];
    }

    public function messages()
    {
        return [
            'company.required' => 'Необходимо выбрать контрагента для привязки контактного лица',
            'company.exists' => 'Контрагент не найден',
            'name.required' => 'Введите полное имя контактного лица',
        ];
    }

}
