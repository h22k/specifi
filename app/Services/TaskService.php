<?php

namespace App\Services;

use App\Models\Task;
use Illuminate\Http\Request;
use Throwable;

class TaskService
{
    /**
     * @param  Request  $request
     * @return Task[]
     */
    public function index(Request $request): array
    {
        return Task::filter($request)->get();
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
