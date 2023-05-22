<?php

use Illuminate\Support\Facades\Route;
use Modules\User\src\Http\Controllers\UserController;

Route::prefix('user')->group(function(){
    Route::get('/',[UserController::class,'index']);

    Route::get('/detail/{id}',[UserController::class,'detail']);

    Route::get('add',[UserController::class,'add']);
});

// Route::group(['namespace' => 'Modules\User\src\Http\Controllers'], function () {
//     // Controllers Within The "App\Http\Controllers\Admin" Namespace
//     Route::prefix('user')->group(function () {
//         Route::get('/', "UserController@index");

//         Route::get('/detail/{id}', "UserController@detail");

//     });
// });