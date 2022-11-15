<?php

use App\Http\Controllers\Project\ProjectController;
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

Route::middleware('auth')->group(function () {
    Route::get('/projects', [ProjectController::class, 'index'])->middleware('author');

    Route::get('/project/create', [ProjectController::class, 'create']);
    Route::post('/project', [ProjectController::class, 'store']);

    Route::get('/project/{id}', [ProjectController::class, 'show']);

    Route::post('/project/{id}', [ProjectController::class, 'update']);
    
    Route::get('/project/{id}/edit', [ProjectController::class, 'edit']);

    Route::get('/project/{id}/delete', [ProjectController::class, 'destroy']);
});
