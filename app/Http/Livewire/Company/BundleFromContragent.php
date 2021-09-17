<?php

namespace App\Http\Livewire\Company;

use App\Models\Company;
use Livewire\Component;
use Livewire\WithPagination;

class BundleFromContragent extends Component
{
    use WithPagination;

    public $searchQuery;

    protected $queryString = [
        'searchQuery' => ['except' => ''],
        'page' => ['except' => 1],
    ];

    public $contragent;

    public $companies;

    public function mount(Company $contragent)
    {
        $this->contragent = $contragent;
    }

    public function attach($company_id)
    {
        $company = Company::find($company_id);

        if ($company) {

            if ($company->id == $this->contragent->id) {

                $this->alert(
                    'Что-то пошло не так...',
                    'Не получится сделать связанной организацией самого контрагента.',
                    'error'
                );

            } else {

                $this->contragent->links()->attach($company);

                $this->alert(
                    'Организация добавлена',
                    'Можно продолжать работу с контрагентом',
                    'success'
                );

            }

        } else {
            $this->alert(
                'Что-то пошло не так...',
                'Недостаточно прав для данного действия, или организация недоступна.',
                'error'
            );
        }

    }

    public function render()
    {
        if (!empty($this->searchQuery)) {
            $searchQuery = '%' . $this->searchQuery . '%';
            $this->companies = Company::where('user_id', auth()->user()->getAuthIdentifier())
                ->where(function ($query) use ($searchQuery) {
                    $query->where('name', 'like', $searchQuery);
                })
                ->where('id', '<>', $this->contragent->id)
                ->take(10)
                ->get();
        } else {
            $this->companies = [];
        }
        return view('livewire.company.bundle-from-contragent', ['companies' => $this->companies]);
    }

    public function alert($message, $text = '', $type = 'warning')
    {
        $this->dispatchBrowserEvent('swal:modal', [
            'type' => $type,
            'message' => $message,
            'text' => $text
        ]);
    }
}
