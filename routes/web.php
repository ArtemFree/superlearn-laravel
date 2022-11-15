<?php

use App\Http\Controllers\Author\AuthorController;
use App\Http\Controllers\User\UserController;
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
    return view('common.welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/user/{id}', [UserController::class, 'index']);
Route::get('/profile', [UserController::class, 'profile']);

Route::get('/author/{id}', [AuthorController::class, 'index']);

Route::get('/authors', [AuthorController::class, 'authors']);


require __DIR__.'/project.php';
require __DIR__.'/auth.php';
