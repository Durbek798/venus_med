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


Route::prefix('regions')->group(function () {

    Route::get('/viloyat', 'regionController@viloyat');
    Route::post('/add-viloyat', 'regionController@addViloyat');
    Route::post('/edit-viloyat/{id}', 'regionController@editViloyat');
    Route::get('/delete-viloyat/{id}', 'regionController@deleteViloyat');

    Route::get('/tuman', 'regionController@Tuman');
    Route::post('/add-tuman', 'regionController@addTuman');
    Route::post('/edit-tuman/{id}', 'regionController@editTuman');
    Route::get('/delete-tuman/{id}', 'regionController@deleteTuman');
    
    Route::get('/kasalxona', 'regionController@kasalxona');
    Route::post('/add-kasalxona', 'regionController@addKasalxona');
    Route::post('/edit-kasalxona/{id}', 'regionController@editKasalxona');
    Route::get('/delete-kasalxona/{id}', 'regionController@deleteKasalxona');

});




Route::get('/home', 'HomeController@index')->name('home');
