<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard;

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

Auth::routes();

// Users
Route::get('/dashboard', [Dashboard\DashboardController::class, 'index']);
Route::get('/dashboard/users', [Dashboard\UserController::class, 'index']);
Route::get('/dashboard/user/edit/{id}', [Dashboard\UserController::class, 'edit']);
Route::put('/dashboard/user/update/{id}', [Dashboard\UserController::class, 'update']);
Route::delete('/dashboard/user/delete/{id}', [Dashboard\UserController::class, 'destroy']);
