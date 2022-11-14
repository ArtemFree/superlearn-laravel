<?php

use App\Http\Controllers\Author\AuthorController;
use App\Http\Controllers\Project\ProjectController;
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

Route::middleware('auth')->group(function() {
    Route::get('/project/create', [ProjectController::class, 'create_page']);
    Route::get('/project/{id}/edit', [ProjectController::class, 'edit_page']);
    Route::post('/project/create', [ProjectController::class, 'create']);
    Route::post('/project/{id}/edit', [ProjectController::class, 'edit']);
    Route::get('/project/{id}/delete', [ProjectController::class, 'delete']);
    
    Route::get('/project/{id}', [ProjectController::class, 'index']);
});

Route::get('/projects', [ProjectController::class, 'projects']);

Route::get('/authors', [AuthorController::class, 'authors']);



require __DIR__.'/auth.php';
