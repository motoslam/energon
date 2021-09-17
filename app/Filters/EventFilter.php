<?php

namespace App\Filters;

class EventFilter extends QueryFilter
{
    public function type($alias)
    {
        return $this->builder->where('category_id', $id);
    }
}
