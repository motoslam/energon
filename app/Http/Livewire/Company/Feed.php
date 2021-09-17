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

    public $filterType;
    public $filterFromDate;
    public $filterToDate;

    protected $listeners = ['eventAdded', 'setFilterType', 'InputEvent'];
    protected $queryString = [
        'filterType' => ['except' => ''],
        'filterFromDate' => ['except' => ''],
        'filterToDate' => ['except' => ''],
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
        $this->events = $company->events;
    }

    public function prepare()
    {
        $this->events = Event::where('company_id', $this->company->id)
            ->whereHasMorph(
                'attachable',
                $this->classNames[$this->filterCategory],
                function (Builder $query) {
                    $query->whereBetween('created_at', [
                        $this->filterFromDate,
                        $this->filterToDate
                    ]);
                }
            )->latest()->get();
    }

    public function setFilterType($type)
    {
        if (array_key_exists($type, $this->classNames)) {
            $this->filterType = $type;
        } else {
            $this->filterType = null;
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
