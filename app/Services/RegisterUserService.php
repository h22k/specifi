<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterUserService
{

    /**
     * @param  array  $data
     * @return void
     */
    public function register(array $data): void
    {
        $user = User::create($data);

        Auth::login($user);
    }

}
