<?php

namespace App\Http\Livewire\Company;

use App\Models\Company;
use App\Models\Order;
use Livewire\Component;
use App\Models\Comment;

class CreateEvent extends Component
{
    public $company;
    public $type = 'comment'; // comment || order || offer
    public $isActive = false;

    public $data;  // text comment
    public $internal_id;  // внешний ID заказа
    public $order_sum;  //сумма заказа
    public $order_date;  // дата заказа
    public $contact; // контактное лицо

    protected $listeners = ['changeEventType', 'changeEventContact'];

    public function mount($company)
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
            ['data' => 'required'],
            ['data.required' => 'Введите текст комментария']
        );

        $event = $this->company->events()->create([
            'user_id' => auth()->user()->id,
            'title' => 'Комментарий'
        ]);

        $comment = Comment::create([
            'company_id' => $this->company->id,
            'user_id' => auth()->user()->getAuthIdentifier(),
            'data' => $validatedData['data'],
        ]);

        $event->attachable()->associate($comment);
        $event->save();

        $this->reset('data');
    }

    public function storeOrder()
    {
        $validatedData = $this->validate(
            [
                'internal_id' => ['required'],
                'order_sum' => ['required', 'numeric'],
            ],
            [
                'internal_id.required' => 'Введите номер заказа',
                'order_sum.required' => 'Введите сумму заказа',
                'order_sum.numeric' => 'Сумма заказа должна быть числом',
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

    public function storeEvent()
    {

    }

    public function render()
    {
        return view('livewire.company.create-event');
    }
}
