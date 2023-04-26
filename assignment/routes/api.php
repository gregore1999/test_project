<?php

use App\Http\Controllers\companiesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/test',[UserController::class,'test'])->name('test');
    Route::get('/companies',[companiesController::class,'getCompanies'])->name('getCompanies');
    Route::get('/events',[UserController::class,'getEvents'])->name('getEvents');
    Route::get('/events/allInfo',[UserController::class,'getAllInformation'])->name('allInfo');
});


Route::post('/login',[UserController::class,'login'])->name('loginFun');
Route::post('/register',[UserController::class,'register'])->name('register');