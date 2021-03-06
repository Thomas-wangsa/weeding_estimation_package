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
Route::get('/upload/{file}', 'HomeController@upload')->name('upload');
Route::get('/cost', 'HomeController@cost')->name('cost');
Route::get('/prediction', 'HomeController@prediction')->name('prediction');
Route::post('/update', 'HomeController@update')->name('update');
Route::post('/create', 'HomeController@create')->name('create');
Route::post('/detail', 'HomeController@detail')->name('detail');
Route::post('/ajax', 'HomeController@ajax')->name('ajax');

Auth::routes();


