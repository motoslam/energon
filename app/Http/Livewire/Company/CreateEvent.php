<?php

namespace App\Http\Livewire\Company;

use App\Models\Call;
use App\Models\Company;
use App\Models\Contact;
use App\Models\Offer;
use App\Models\Order;
use Livewire\Component;
use App\Models\Comment;

class CreateEvent extends Component
{
    public $company;
    public $type = 'comment';
    public $isActive = false;

    public $data;               /** Комментарий */
    public $internal_id;        /** Внешний ID заказа в системе завода */
    public $order_sum;          /** Сумма заказа */
    public $order_date;         /** Дата заказа или заявки */
    public $contact;            /** Контактное лицо */

    protected $listeners = ['changeEventType', 'changeEventContact'];

    protected $messages = [
        'data.required' => 'Комментарий является обязательным полем.',
        'contact.exists' => 'Указанный контакт не найдено в системе.',
        'internal_id.required' => 'Номер документа обязателен для заполнения.',
        'order_sum.required' => 'Сумма заказа обязательна для заполнения.',
        'order_sum.numeric' => 'Сумма заказа должна принимать числовое значение.',
    ];

    public function mount(Company $company)
    {
        $this->company = $company;
        $this->order_date = now()->format('d.m.Y');
    }

    public function changeEventType($type)
    {
        $this->type = $type;
    }
    public function changeEventContact($contact)
    {
        $this->contact = $contact;
    }

    public function store()
    {
        switch ($this->type) {
            case 'comment':
                $this->storeComment();
                break;
            case 'order':
                $this->storeOrder();
                break;
            case 'offer':
                $this->storeOffer();
                break;
            case 'call':
                $this->storeCall();
                break;
            default:
                $this->storeEvent();
                break;
        }

        $this->emit('eventAdded');

        $this->isActive = false;

    }

    public function storeComment()
    {
        $validatedData = $this->validate(
            [
                'data' => ['required'],
                'contact' => $this->contactRules()
            ]
        );

        $event = $this->company->events()->create([
            'user_id' => auth()->user()->id,
            'title' => 'Комментарий'
        ]);

        $comment = Comment::create([
            'company_id' => $this->company->id,
            'user_id' => auth()->user()->getAuthIdentifier(),
            'contact_id' => $validatedData['contact'] ?? null,
            'data' => $validatedData['data'],
        ]);

        $event->attachable()->associate($comment);
        $event->save();

        $this->reset('data', 'contact');
    }

    public function storeOrder()
    {
        $validatedData = $this->validate(
            [
                'internal_id' => ['required'],
                'order_sum' => ['required', 'numeric'],
            ]
        );

        $event = $this->company->events()->create([
            'user_id' => auth()->user()->getAuthIdentifier(),
            'title' => 'Заказ #' . $validatedData['internal_id']
        ]);

        $order = Order::create([
            'company_id' => $this->company->id,
            'user_id' => auth()->user()->getAuthIdentifier(),
            'internal_id' => $validatedData['internal_id'],
            'data' => $validatedData['data'] ?? null,
            'total' => $validatedData['order_sum'],
            'order_date' => $validatedData['order_date'] ?? now()
        ]);

        $event->attachable()->associate($order);
        $event->save();

        $this->reset('data', 'internal_id', 'order_sum', 'order_date');
    }

    public function storeOffer()
    {
        $validatedData = $this->validate(
            [
                'internal_id' => ['required'],
                'contact' => $this->contactRules(),
            ]
        );

        $event = $this->company->events()->create([
            'user_id' => auth()->user()->getAuthIdentifier(),
            'title' => 'Заявка #' . $validatedData['internal_id']
        ]);

        $offer = Offer::create([
            'company_id' => $this->company->id,
            'user_id' => auth()->user()->getAuthIdentifier(),
            'contact_id' => $validatedData['contact'] ?? null,
            'internal_id' => $validatedData['internal_id'],
            'data' => $validatedData['data'] ?? null,
            'offer_date' => $validatedData['order_date'] ?? now()
        ]);

        $event->attachable()->associate($offer);
        $event->save();

        $this->reset('data', 'internal_id', 'contact', 'order_date');
    }

    public function storeCall()
    {
        $validatedData = $this->validate(
            [
                'data' => ['required'],
                'contact' => $this->contactRules(),
            ]
        );

        $event = $this->company->events()->create([
            'user_id' => auth()->user()->getAuthIdentifier(),
            'title' => 'Телефонный звонок'
        ]);

        $call = Call::create([
            'company_id' => $this->company->id,
            'user_id' => auth()->user()->getAuthIdentifier(),
            'contact_id' => $validatedData['contact'] ?? null,
            'data' => $validatedData['data'] ?? null
        ]);

        $event->attachable()->associate($call);
        $event->save();

        $this->reset('data', 'contact');
    }

    public function storeEvent()
    {
        $event = $this->company->events()->create([
            'user_id' => auth()->user()->getAuthIdentifier(),
            'title' => 'Новое событие'
        ]);

        $this->reset('data', 'contact');
    }

    protected function contactRules()
    {
        return [
            'numeric',
            'nullable',
            'exists:App\Models\Contact,id',
            function ($attribute, $value, $fail) {
                $contact = Contact::find($value);
                if ($contact->company != $this->company) {
                    $fail('Указанное контактное лицо не привязано к данной организации.');
                }
            },
        ];
    }

    public function render()
    {
        return view('livewire.company.create-event');
    }
}
