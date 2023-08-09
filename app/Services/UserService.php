<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserService
{

    /**
     * @return Collection
     */
    public function index(): Collection
    {
        return User::all();
    }

}
