<?php

namespace App\Filters;

use App\Models\Call;
use App\Models\Comment;
use App\Models\Offer;
use App\Models\Order;
use App\Models\Task;

class EventFilter extends QueryFilter
{
    protected $classNames = [
        'comment' => Comment::class,
        'call' => Call::class,
        'order' => Order::class,
        'offer' => Offer::class,
        'task' => Task::class,
    ];

    public function type($alias)
    {
        return $this->builder->whereHasMorph(
            'attachable',
            $this->classNames[$alias]
        );
    }
}
