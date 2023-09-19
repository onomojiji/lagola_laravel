<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware(["auth"])->prefix('admin')->group(function (){
    // dashboards routes
    Route::controller(\App\Http\Controllers\Admin\HomeController::class)->group(function (){
        Route::get('/', 'home')->name('home');
    });

    // Users routes
    Route::controller(\App\Http\Controllers\Admin\UserController::class)->group(function (){
        Route::get("users/list", 'index')->name("users.index");
        Route::get("users/create", 'create')->name("users.create");
        Route::get("users/edit/{user_id}", 'edit')->name("users.edit");
        Route::post("users/store", 'store')->name("users.store");
        Route::post("users/update/{user_id}", 'update')->name("users.update");
    });

    // companies routes
    Route::controller(\App\Http\Controllers\Admin\CompanyController::class)->group(function (){
        Route::get("companies/list", 'index')->name("companies.index");
        Route::get("companies/create", 'create')->name("companies.create");
        Route::get("companies/edit/{user_id}", 'edit')->name("companies.edit");
        Route::post("companies/store", 'store')->name("companies.store");
        Route::post("companies/update/{user_id}", 'update')->name("companies.update");
    });

});

require __DIR__.'/auth.php';
