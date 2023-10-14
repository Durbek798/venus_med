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

Auth::routes();

Route::prefix('users')->group(function () {
    Route::get('/', 'userController@index');
    Route::post('/add-user', 'userController@add');
    Route::post('/edit-user/{id}', 'userController@edit');
    Route::get('/delete-user/{id}', 'userController@delete');
    Route::get('/set-user-to-admin/{id}', 'userController@admin');
});






Route::get('/home', 'HomeController@index')->name('home');
