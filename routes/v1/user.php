<?php

use App\Http\Controllers\Api\UserController;

Route::name('users.')->controller(UserController::class)->group(static function () {

    Route::get('/', 'index')->name('index');

});
