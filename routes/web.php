<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\AuthController;

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

Route::middleware('guest')->group(function () {
    Route::get('/register/', [AuthController::class, 'register'])->name('register');
    Route::post('/signUp/', [AuthController::class, 'signUp'])->name('signUp');

    Route::get('/login/', [AuthController::class, 'login'])->name('login');
    Route::post('/signIn/', [AuthController::class, 'signIn'])->name('signIn');

//    Route::get('/forgotPassword/', [AuthController::class, 'forgotPassword'])->name('forgotPassword');
});


Route::middleware('auth')->group(function () {
    Route::post('/logout/', [AuthController::class, 'logout'])->name('logout');


    Route::get('/', [TaskController::class, 'index'])->name('home');

    Route::get('/task/add/', [TaskController::class, 'add'])->name('taskAdd');
    Route::post('/task/store/', [TaskController::class, 'store'])->name('taskStore');

    Route::get('task/{task}/show', [TaskController::class, 'show'])->name('taskShow');
});
