<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriasController;


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

Route::middleware(['auth:sanctum', 'verified'])->group(function(){
    Route::get('/dashboard',[CategoriasController::class, 'index'])->name('dashboard');

    Route::get('/categoria',[CategoriasController::class, 'add']);
    Route::post('/categoria',[CategoriasController::class, 'create']);

    Route::get('/categoria/{categoria}', [CategoriasController::class, 'edit']);
    Route::post('/categoria/{categoria}', [CategoriasController::class, 'update']);
});
