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
    return view('welcome');
});

Route::get('/user/{id}', [UserController::class, 'index']);

Route::get('/author/{id}', [AuthorController::class, 'index']);

Route::get('/project/{id}', [ProjectController::class, 'index']);

Route::get('/signin', function() {
    return 'signin page';   
});

Route::get('/signup/user', function() {
    return 'signup user page';
});

Route::get('/signup/author', function() {
    return 'signup author page';
});

Route::get('/projects', [ProjectController::class, 'projects']);

Route::get('/authors', [AuthorController::class, 'authors']);
