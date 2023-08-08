<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class BaseFilter
{

    protected Builder $builder;

    public function apply(Builder $builder, Request $request): Builder
    {
        $this->builder = $builder;
        $filters = $request->query();

        foreach ($filters as $field => $value) {
            if ( ! method_exists($this, $field) || strlen($value) < 1) {
                continue;
            }

            $this->$field($value);
        }

        return $this->builder;
    }
}
