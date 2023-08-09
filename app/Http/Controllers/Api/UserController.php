<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Response\ApiResponse;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * @param  Request  $request
     * @param  UserService  $service
     * @return JsonResponse
     */
    public function __invoke(Request $request, UserService $service): JsonResponse
    {
        $users = $service->index();

        return ApiResponse::success(compact('users'));
    }
}
