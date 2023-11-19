<?php

use App\Http\Controllers\API\Auth\AuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

////////////////////////////////////////////////////////////////
// AUTH ROUTES
////////////////////////////////////////////////////////////////

Route::post('/sellers/login', [AuthController::class, 'store'])->name("api.login.store");

Route::middleware(["auth:sanctum"])->prefix("/sellers/")->group(function (){

////////////////////////////////////////////////////////////////
// AUTH ROUTES
////////////////////////////////////////////////////////////////

   Route::controller(\App\Http\Controllers\API\Auth\AuthController::class)->group(function (){
      // get the auth user informations
       Route::get("user", 'user')->name("api.user.get");

       // logout
       Route::get("logout", "destroy")->name("api.logout");
   });

   // homes routes
    Route::controller(\App\Http\Controllers\API\AccueilController::class)->group(function (){
        Route::get("home", "home")->name("home.products");
        Route::get("homeInStock", "homeInStock")->name("home.inStock");
    });

   // sellers products routes
    Route::controller(\App\Http\Controllers\API\ProductController::class)->group(function (){
       Route::post("getInCompany", "inputProduct")->name("products.gestImCompany");
       Route::post("sellProduct", "sellProduct")->name("products.sell");
       Route::get("getnewsell", "getnewsell")->name('product.getnewsell');
        Route::get("gethistory", "gethistory")->name('product.gethistory');
    });

});

