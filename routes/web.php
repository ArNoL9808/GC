<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MetricaController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::get('list-patients', [HomeController::class, 'list_patients'])->name('list.patients');
Route::get('new-patient', [HomeController::class, 'new_patient'])->name('new.patient');

Auth::routes();
Route::group(['middleware' => 'auth'], function () {
Route::get('{any}',[MetricaController::class,'index']);
});

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
