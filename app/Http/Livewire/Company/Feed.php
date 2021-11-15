<?php

namespace App\Http\Livewire\Company;

use App\Models\Comment;
use App\Models\Order;
use App\Models\Offer;
use App\Models\Task;
use App\Models\Call;
use App\Models\Company;
use App\Models\Event;
use Livewire\Component;

use App\Filters\EventFilter;

class Feed extends Component
{
    public $company;
    public $events;

    public $type;
    public $from;
    public $to;


    protected $listeners = ['eventAdded', 'setFilterType', 'InputEvent'];

    protected $queryString = [
        'type' => ['except' => ''],
        'from' => ['except' => ''],
        'to' => ['except' => ''],
    ];

    protected $classNames = [
        'comment' => Comment::class,
        'call' => Call::class,
        'order' => Order::class,
        'offer' => Offer::class,
        'task' => Task::class,
    ];

    public function mount($company)
    {
        $this->company = $company;
        $this->prepare();
    }

    public function prepare()
    {
        $query = Event::where('company_id', $this->company->id);
        if ($this->type) {
            $query->type($this->classNames[$this->type]);
        }
        if ($this->from && strtotime($this->from) !== false) {
            $query->since($this->from);
        }
        if ($this->to && strtotime($this->to) !== false) {
            $query->to($this->to);
        }
        $this->events = $query->latest()->get();
    }

    public function setFilterType($type)
    {
        if (array_key_exists($type, $this->classNames)) {
            $this->type = $type;
        } else {
            $this->type = null;
        }
        $this->prepare();
    }

    public function updated($name, $value)
    {
        if($name == 'from' || $name == 'to') {
            $this->prepare();
        }
    }

    public function eventAdded()
    {
        $this->events = $this->company->events->fresh('attachable');
    }

    public function render()
    {
        return view('livewire.company.feed');
    }
}
