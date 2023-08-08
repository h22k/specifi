<?php

namespace App\Filters\Contracts;

use App\Filters\BaseFilter;

interface IFilterable
{

    public function getFilterClass(): BaseFilter;

}
