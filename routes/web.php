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

Route::get('/', function () {
    return view('welcome');
});
Route::get('get-directory', [IndexController::class, 'getDirectory']);
Route::post('uploading-file-api', [FileController::class, 'upload']);