<?php

use App\Http\Controllers\Api\TaskController;

Route::apiResources([
    'tasks' => TaskController::class,
]);
