<?php

use Illuminate\Support\Facades\Route;
use Modules\Teachers\src\Http\Controllers\TeachersController;

Route::prefix('admin')->middleware('web')->name('admin.')->group(function(){
    Route::prefix('teachers')->name('teachers.')->group(function(){
        Route::get('/',[TeachersController::class,'index'])->name('index');
        
        Route::get('/add',[TeachersController::class,'add'])->name('add');

        Route::post('/add',[TeachersController::class,'post_add']);

        Route::get('/data',[TeachersController::class,'data'])->name('data');

        Route::get('/update/{id}',[TeachersController::class,'update'])->name('update');

        Route::post('/update/{id}',[TeachersController::class,'post_update']);

        Route::get('/delete/{id}',[TeachersController::class,'delete'])->name('delete');
    });
});