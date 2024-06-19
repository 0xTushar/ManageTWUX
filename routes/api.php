<?php

use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\TaskController;

Route::post('/login', [LoginController::class, 'authenticate']);

Route::group(['as' => 'api.', 'middleware' => ['auth:sanctum']], function () {

    Route::get('get-twitter', [TaskController::class, 'reserveAccount']);

    Route::get('get-twitter/{username}/good', [TaskController::class, 'good']);
    Route::get('get-twitter/{username}/bad', [TaskController::class, 'bad']);

    Route::get('/connected/{tokenId}/{twitterId?}', [TaskController::class, 'connected']);
});
