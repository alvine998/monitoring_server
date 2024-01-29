<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FirebaseAuthController;
use App\Http\Controllers\GuideController;
use App\Http\Controllers\HistoryController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [FirebaseAuthController::class, 'index'])->name('login.index');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
Route::get('/history', [HistoryController::class, 'index'])->name('history.index');
Route::get('/guide', [GuideController::class, 'index'])->name('guide.index');
