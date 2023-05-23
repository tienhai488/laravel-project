<?php 
use Illuminate\Support\Facades\Route;
use Modules\Dashboard\src\Http\Controllers\DashboardController;

Route::get('admin', [DashboardController::class,'index']);