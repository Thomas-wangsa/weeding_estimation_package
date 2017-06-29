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
Route::get('/edit/{id}', 'HomeController@edit')->name('edit');
Route::get('/delete/{id}/{status}', 'HomeController@delete')->name('delete');
Route::post('/update', 'HomeController@update')->name('update');
Route::post('/create', 'HomeController@create')->name('create');

Auth::routes();


