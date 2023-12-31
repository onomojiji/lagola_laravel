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
        Route::get("companies/edit/{company_id}", 'edit')->name("companies.edit");
        Route::post("companies/store", 'store')->name("companies.store");
        Route::post("companies/update/{company_id}", 'update')->name("companies.update");

        Route::get("companies/show/{company_id}", 'show')->name("companies.show");
    });

    // sellers routes
    Route::controller(\App\Http\Controllers\Admin\SellerController::class)->group(function (){
        Route::get("sellers/list", 'index')->name("sellers.index");
        Route::get("sellers/create", 'create')->name("sellers.create");
        Route::get("sellers/edit/{seller_id}", 'edit')->name("sellers.edit");
        Route::post("sellers/store", 'store')->name("sellers.store");
        Route::post("sellers/update/{seller_id}", 'update')->name("sellers.update");
    });

    // categories routes
    Route::controller(\App\Http\Controllers\Admin\CategoryController::class)->group(function (){
        Route::get("catalog/categories/list", 'index')->name("categories.index");
        Route::get("catalog/categories/create", 'create')->name("categories.create");
        Route::get("catalog/categories/edit/{category_id}", 'edit')->name("categories.edit");
        Route::post("catalog/categories/store", 'store')->name("categories.store");
        Route::post("catalog/categories/update/{category_id}", 'update')->name("categories.update");
    });

    // products routes
    Route::controller(\App\Http\Controllers\Admin\ProductController::class)->group(function (){
        Route::get("catalog/products/list", 'index')->name("products.index");
        Route::get("catalog/products/create", 'create')->name("products.create");
        Route::get("catalog/products/edit/{product_id}", 'edit')->name("products.edit");
        Route::post("catalog/products/store", 'store')->name("products.store");
        Route::post("catalog/products/update/{product_id}", 'update')->name("products.update");

        Route::get("catalog/products/addInCompany", 'getInCompany')->name("products.getInCompany");
        Route::post("catalog/products/addInCompany", 'addInCompany')->name("products.addInCompany");
    });

    // pertes routes
    Route::controller(\App\Http\Controllers\Admin\PerteController::class)->group(function (){
       Route::get("company/{company_id}/product/{product_id}/pertes", "perte")->name("pertes.store");
    });

});

require __DIR__.'/auth.php';
