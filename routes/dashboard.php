<?php

use App\Http\Controllers\Dashboard\CategoriesController;
use App\Http\Controllers\Dashboard\DashboardController;
use Illuminate\Support\Facades\Route;


//Route::resource('dashboard/categories', CategoriesController::class)->middleware(['auth'])
//->names([
//    'index' => 'dashboard.categories.index',
//    'create' => 'dashboard.categories.create',
//    .....
//]);

Route::group([
    'middleware' => ['auth'],
    'as' => 'dashboard.',
    'prefix' => 'dashboard',
    // 'namespace' => 'App\Http\Controllers\Dashboard',
], function () {
    //    Route::get('/', ['DashboardController@index']);
    Route::get('/', [DashboardController::class, 'index']);
    Route::resource('/categories', CategoriesController::class);
});
//Route::middleware('auth')->as('dashboard')->prefix('dashboard')->group(function () {});
