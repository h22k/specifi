<?php

namespace App\Filters\Helper;

use App\Exceptions\FiltersNotImplementedException;
use App\Filters\BaseFilter;
use App\Filters\Contracts\IFilterable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

trait Filterable
{

    /**
     * @param $query
     * @param  Request  $request
     * @return Builder
     * @throws FiltersNotImplementedException
     */
    public function scopeFilter($query, Request $request): Builder
    {
        if ( ! ($this instanceof IFilterable)) {
            throw new FiltersNotImplementedException(self::class);
        }

        $filter = $this->getFilterClass();

        return $filter->apply($query, $request);
    }

}
