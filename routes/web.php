<?php

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

//Auth::routes();
Route::group(['middleware' => ['auth', 'client']], function() {
    Route::post('/clients/request', 'ClientsController@store');
});

Route::group(['middleware' => ['auth', 'vendor']], function() {
    Route::post('/vendors/execute/{id}', 'VendorsController@execute');
});