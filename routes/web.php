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

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/accountbook', 'AccountbookController@index');
Route::get('accountbook/create', 'AccountbookController@add');
Route::post('accountbook/create', 'AccountbookController@create');
Route::get('accountbook/delete', 'AccountbookController@delete');
Route::get('accountbook/edit', 'AccountbookController@edit');
Route::post('accountbook/edit', 'AccountbookController@update');
