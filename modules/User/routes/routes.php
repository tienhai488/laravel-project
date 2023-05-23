<?php

use Illuminate\Support\Facades\Route;
use Modules\User\src\Http\Controllers\UserController;

Route::prefix('admin')->name('admin.')->group(function(){
    Route::prefix('user')->name('user.')->group(function(){
        Route::get('/',[UserController::class,'index'])->name('index');
        
        Route::get('add',[UserController::class,'add'])->name('add');

    });
});