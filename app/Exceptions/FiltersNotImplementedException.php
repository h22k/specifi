<?php

namespace App\Exceptions;

use Exception;

class FiltersNotImplementedException extends Exception
{
    public function __construct(string $className)
    {
        parent::__construct("Filters has not implemented to $className");
    }
}
