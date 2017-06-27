<?php

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

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/list', 'HomeController@list')->name('list');
Route::get('/add', 'HomeController@add')->name('add');
Route::post('/add', 'HomeController@create')->name('create');
Auth::routes();


