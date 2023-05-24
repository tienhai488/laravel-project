<?php

use Illuminate\Support\Facades\Route;
use Modules\User\src\Http\Controllers\UserController;

Route::prefix('admin')->middleware('web')->name('admin.')->group(function(){
    Route::prefix('users')->name('users.')->group(function(){
        Route::get('/',[UserController::class,'index'])->name('index');
        
        Route::get('add',[UserController::class,'add'])->name('add');

        Route::post('add',[UserController::class,'post_add'])->name('post_add');

        Route::get('data',[UserController::class,'data'])->name('data');

        Route::get('update/{id}',[UserController::class,'update'])->name('update');

        Route::post('update/{id}',[UserController::class,'post_update'])->name('post_update');

        Route::get('delete/{id}',[UserController::class,'delete'])->name('delete');
    });
});