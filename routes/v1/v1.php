<?php

use App\Http\Controllers\Api\TaskCategoryController;
use App\Http\Controllers\Api\TaskController;

Route::name('v1.')->group(static function () {

    Route::apiResources([
        'tasks'           => TaskController::class,
        'task_categories' => TaskCategoryController::class,
    ]);

    Route::prefix('users')->group(base_path('routes/v1/user.php'));

});
