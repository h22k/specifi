<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTaskCategoryRequest;
use App\Http\Requests\UpdateTaskCategoryRequest;
use App\Http\Response\ApiResponse;
use App\Models\TaskCategory;
use App\Services\TaskCategoryService;
use Throwable;

class TaskCategoryController extends Controller
{
    public function __construct(private readonly TaskCategoryService $taskCategoryService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $taskCategories = $this->taskCategoryService->index();

        return ApiResponse::success(['task_categories' => $taskCategories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskCategoryRequest $request)
    {
        $taskCategory = $this->taskCategoryService->store($request->validated());

        return ApiResponse::created(['task_category' => $taskCategory]);
    }

    /**
     * Display the specified resource.
     */
    public function show(TaskCategory $taskCategory)
    {
        return ApiResponse::success(['task_category' => $taskCategory]);
    }

    /**
     * Update the specified resource in storage.
     * @throws Throwable
     */
    public function update(UpdateTaskCategoryRequest $request, TaskCategory $taskCategory)
    {
        $this->taskCategoryService->update($request->validated(), $taskCategory);

        return ApiResponse::updated();
    }

    /**
     * Remove the specified resource from storage.
     * @throws Throwable
     */
    public function destroy(TaskCategory $taskCategory)
    {
        $this->taskCategoryService->destroy($taskCategory);

        return ApiResponse::deleted();
    }
}
