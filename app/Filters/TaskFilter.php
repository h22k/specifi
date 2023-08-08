<?php

namespace App\Filters;

class TaskFilter extends BaseFilter
{
    public function search(string $search): void
    {
        $this->builder
            ->where('title', 'ILIKE', "%$search%")
            ->orWhere('description', 'ILIKE', "%$search%"); // i know it's a performance killer, i should have implemented elasticsearch or something but i decided to do not.
    }
}
