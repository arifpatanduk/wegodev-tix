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

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [Dashboard\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/theaters', [Dashboard\TheatersController::class, 'index'])->name('dashboard.theaters');
    Route::get('/dashboard/tickets', [Dashboard\TicketsController::class, 'index'])->name('dashboard.tickets');

    // Movies
    Route::get('/dashboard/movies', [Dashboard\MovieController::class, 'index'])->name('dashboard.movies');
    Route::get('/dashboard/movies/create', [Dashboard\MovieController::class, 'create'])->name('dashboard.movies.create');
    Route::get('/dashboard/movies/{id}', [Dashboard\MovieController::class, 'edit'])->name('dashboard.movies.edit');
    Route::put('/dashboard/movies/{id}', [Dashboard\MovieController::class, 'update'])->name('dashboard.movies.update');
    Route::post('/dashboard/movies/', [Dashboard\MovieController::class, 'store'])->name('dashboard.movies.store');
    Route::delete('/dashboard/movies/', [Dashboard\MovieController::class, 'destroy'])->name('dashboard.movies.delete');

    // Users
    Route::get('/dashboard/users', [Dashboard\UserController::class, 'index'])->name('dashboard.users');
    Route::get('/dashboard/users/{id}', [Dashboard\UserController::class, 'edit'])->name('dashboard.users.edit');
    Route::put('/dashboard/users/{id}', [Dashboard\UserController::class, 'update'])->name('dashboard.users.update');
    Route::delete('/dashboard/users/{id}', [Dashboard\UserController::class, 'destroy'])->name('dashboard.users.delete');
});
