<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\FileController;
use App\Http\Controllers\API\IndexController;

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

Route::get('get-directory', [IndexController::class, 'getDirectory']);
Route::get('get-user-name', [IndexController::class, 'getUser']);
Route::post('create-folder', [FileController::class, 'create']);
Route::post('upload-file', [FileController::class, 'upload']);
Route::post('delete-item', [FileController::class, 'delete']);
Route::post('rename-item', [FileController::class, 'rename']);

Auth::routes();
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('/');
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('/');