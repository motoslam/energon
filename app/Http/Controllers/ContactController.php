<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactCreateRequest;
use App\Http\Requests\ContactEditRequest;
use App\Models\Company;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    public function index()
    {
        // TODO: Оптимизировать tailwind.css

        return view('contact.index');
    }

    public function create(Request $request)
    {
        $templateData['company'] = null;
        if ($request->get('company')) {
            $company = $request->user()->companies->where('ssn', $request->get('company'))->first();
            if ($company) {
                $templateData['company'] = $company;
            }
        }

        $templateData['btnText'] = 'Создать контакт';

        return view('contact.create', $templateData);
    }

    public function store(ContactCreateRequest $request)
    {
        $company = Company::find($request->company);
        $newContact = $company->contacts()->create([
            'user_id' => $request->user()->id,
            'position' => $request->position,
            'name' => $request->name
        ]);

        foreach ($request->phones as $phone) {
            if (!empty($phone)) {
                $newContact->phones()->create([
                    'data' => $phone
                ]);
            }
        }

        foreach ($request->emails as $email) {
            if (!empty($email)) {
                $newContact->emails()->create([
                    'data' => $email
                ]);
            }
        }

        return redirect()->route('companies.show', ['company' => $company])->with([
            'success' => 'Создан новый контакт'
        ]);

    }

    public function edit(Contact $contact)
    {
        $templateData['contact'] = $contact;
        $templateData['company'] = $contact->company;

        $templateData['phones'] = $contact->phones->implode('data', '\',\'');
        $templateData['emails'] = $contact->emails->implode('data', '\',\'');

        $templateData['btnText'] = 'Сохранить изменения';

        return view('contact.edit', $templateData);
    }

    public function update(ContactEditRequest $request, Contact $contact)
    {
        $contact->position = $request->position;
        $contact->name = $request->name;

        $contact->phones()->delete();
        foreach ($request->phones as $phone) {
            if (!empty($phone)) {
                $contact->phones()->create([
                    'data' => $phone
                ]);
            }
        }

        $contact->emails()->delete();
        foreach ($request->emails as $email) {
            if (!empty($email)) {
                $contact->emails()->create([
                    'data' => $email
                ]);
            }
        }

        $contact->save();

        $company = $contact->company;

        return redirect()->route('companies.show', ['company' => $company])->with([
            'success' => 'Изменения сохранены'
        ]);
    }

    public function destroy(Contact $contact)
    {
        $company = $contact->company;

        if ($contact && $contact->user_id == Auth::user()->id) {
            $contact->delete();
        }

        return redirect()->route('companies.show', ['company' => $company])->with([
            'success' => 'Контакт удален'
        ]);
    }
}
