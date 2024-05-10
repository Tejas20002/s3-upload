<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FileController;
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
    return view('filemanager');
});
Route::post('/upload', [FileController::class, 'upload']);
Route::get('/list-files', [FileController::class, 'listFiles']);
Route::post('/delete-file',[FileController::class, 'deleteFile']);