<?php

namespace App\Models;

use App\Filters\BaseFilter;
use App\Filters\Contracts\IFilterable;
use App\Filters\Helper\Filterable;
use App\Filters\TaskFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model implements IFilterable
{
    use HasFactory, Filterable;

    public function getFilterClass(): BaseFilter
    {
        return new TaskFilter;
    }
}
