<?php

use App\Http\Controllers\CrudController;
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

Route::get('/',[CrudController::class,'index']);
Route::view('/add','forms');
Route::post('/post',[CrudController::class,'Store']);
Route::get('/edit/{id}',[CrudController::class,'edit']);
Route::post('/post/edit/{id}',[CrudController::class,'update']);
Route::get('/delete/{id}',[CrudController::class,'delete']);
