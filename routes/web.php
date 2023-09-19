<?php

use App\Http\Controllers\ProfileController;
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
    Route::controller(\App\Http\Controllers\Admin\HomeController::class)->group(function (){
        Route::get('/', 'home')->name('home');
    });
});

require __DIR__.'/auth.php';
