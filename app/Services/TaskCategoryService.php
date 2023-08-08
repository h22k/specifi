<?php

namespace App\Services;

use App\Models\TaskCategory;
use Throwable;

class TaskCategoryService
{
    /**
     * @return TaskCategory[]
     */
    public function index(): array
    {
        return TaskCategory::all();
    }

    /**
     * @param  array  $data
     * @return TaskCategory
     */
    public function store(array $data): TaskCategory
    {
        return TaskCategory::create($data);
    }

    /**
     * @param  array  $data
     * @param  TaskCategory  $task
     * @return bool
     * @throws Throwable
     */
    public function update(array $data, TaskCategory $task): bool
    {
        return $task->updateOrFail($data);
    }

    /**
     * @param  TaskCategory  $task
     * @return bool
     * @throws Throwable
     */
    public function destroy(TaskCategory $task): bool
    {
        return $task->deleteOrFail();
    }
}
