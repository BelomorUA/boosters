<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::resource('countries', CountryController::class);
Route::resource('companies', CompanyController::class);
Route::get('leaders', [ReportController::class, 'leaders'])->name('leaders.index');
Route::post('generate-data', [ReportController::class, 'generateData'])->name('generateData');
Route::post('show-report', [ReportController::class, 'showReport'])->name('showReport');
