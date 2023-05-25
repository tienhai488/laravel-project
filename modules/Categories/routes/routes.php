<?php 
use Illuminate\Support\Facades\Route;
use Modules\Categories\src\Http\Controllers\CategoriesController;

Route::prefix('admin')->middleware('web')->name('admin.')->group(function(){
    Route::prefix('categories')->name('categories.')->group(function(){
        Route::get('/',[CategoriesController::class,'index'])->name('index');
        
        Route::get('add',[CategoriesController::class,'add'])->name('add');

        Route::post('add',[CategoriesController::class,'post_add'])->name('post_add');

        Route::get('data',[CategoriesController::class,'data'])->name('data');

        Route::get('update/{id}',[CategoriesController::class,'update'])->name('update');

        Route::post('update/{id}',[CategoriesController::class,'post_update'])->name('post_update');

        Route::get('delete/{id}',[CategoriesController::class,'delete'])->name('delete');
    });
});