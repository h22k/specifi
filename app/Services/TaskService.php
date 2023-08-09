<?php

namespace App\Services;

use App\Models\Task;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Throwable;

class TaskService
{
    /**
     * @param  Request  $request
     * @return Builder
     */
    public function index(Request $request): Builder
    {
        return Task::filter($request);
    }

    /**
     * @param  array  $data
     * @return Task
     */
    public function store(array $data): Task
    {
        return Task::create($data);
    }

    /**
     * @param  array  $data
     * @param  Task  $task
     * @return bool
     * @throws Throwable
     */
    public function update(array $data, Task $task): bool
    {
        return $task->updateOrFail($data);
    }

    /**
     * @param  Task  $task
     * @return bool
     * @throws Throwable
     */
    public function destroy(Task $task): bool
    {
        return $task->deleteOrFail();
    }
}
