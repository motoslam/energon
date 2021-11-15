<?php

namespace App\Observers;

use App\Models\Company;

class CompanyObserver
{

    public function created(Company $company)
    {
        $company->events()->create([
            'user_id' => auth()->user()->id,
            'title' => 'Организация добавлена в систему: ' . auth()->user()->name
        ]);
    }

    public function updating(Company $company)
    {
        if($company->isDirty('company_status_id')) {
            $company->events()->create([
                'user_id' => auth()->user()->id,
                'title' => 'Изменение статуса'
            ]);
        }
    }

    public function deleted(Company $company)
    {
        //
    }

    public function restored(Company $company)
    {
        //
    }

    public function forceDeleted(Company $company)
    {
        //
    }
}
