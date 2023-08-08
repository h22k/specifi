<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Response\ApiResponse;
use App\Models\Task;
use App\Services\TaskService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

class TaskController extends Controller
{
    public function __construct(private readonly TaskService $taskService)
    {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        $tasks = $this->taskService->index($request);

        return ApiResponse::success(compact('tasks'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request): JsonResponse
    {
        $task = $this->taskService->store($request->validated());

        return ApiResponse::created(compact('task'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task): JsonResponse
    {
        return ApiResponse::success(compact('task'));
    }

    /**
     * Update the specified resource in storage.
     * @throws Throwable
     */
    public function update(UpdateTaskRequest $request, Task $task): JsonResponse
    {
        $this->taskService->update($request->validated(), $task);

        return ApiResponse::updated();
    }

    /**
     * Remove the specified resource from storage.
     * @throws Throwable
     */
    public function destroy(Task $task): JsonResponse
    {
        $this->taskService->destroy($task);

        return ApiResponse::deleted();
    }
}
