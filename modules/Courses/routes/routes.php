<?php

use Illuminate\Support\Facades\Route;
use Modules\Courses\src\Http\Controllers\CoursesController;

Route::prefix('admin')->middleware('web')->name('admin.')->group(function(){
    Route::prefix('courses')->name('courses.')->group(function(){
        Route::get('/',[CoursesController::class,'index'])->name('index');
        
        Route::get('/add',[CoursesController::class,'add'])->name('add');

        Route::post('/add',[CoursesController::class,'post_add']);

        Route::get('/data',[CoursesController::class,'data'])->name('data');

        Route::get('/update/{id}',[CoursesController::class,'update'])->name('update');

        Route::post('/update/{id}',[CoursesController::class,'post_update']);

        Route::get('/delete/{id}',[CoursesController::class,'delete'])->name('delete');
    });
});