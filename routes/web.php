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

Route::prefix('accountbook')->name('accountbook.')->group(function () {
    Route::get('/', 'AccountbookController@home')->name('home');
    Route::get('create', 'AccountbookController@add')->name('create');
    Route::post('create', 'AccountbookController@create')->name('create');
    Route::get('delete', 'AccountbookController@delete')->name('delete');
    Route::get('edit', 'AccountbookController@edit')->name('edit');
    Route::post('edit', 'AccountbookController@update')->name('edit');
    Route::get('eachYear', 'AccountbookController@eachYear')->name('eachYear');
    Route::get('eachAmount', 'AccountbookController@eachAmount')->name('eachAmount');
    Route::get('eachAmount/index', 'AccountbookController@amountMonth')->name('eachAmount.index');
    Route::get('eachAmount/amountCategory', 'AccountbookController@amountCategory')->name('eachAmount.amountCategory');
    Route::get('eachAmount/amountTag', 'AccountbookController@amountTag')->name('eachAmount.amountTag');
    Route::get('search', 'AccountbookController@search')->name('search');
    Route::get('search/searchResults', 'AccountbookController@searchResults')->name('search.searchResults');
});

Route::prefix('category')->name('category.')->group(function () {
    Route::get('create', 'CategoryController@add')->name('create');
    Route::post('create', 'CategoryController@create')->name('create');
    Route::get('index', 'CategoryController@index')->name('index');
    Route::get('edit', 'CategoryController@edit')->name('edit');
    Route::post('edit', 'CategoryController@update')->name('edit');
    Route::get('delete', 'CategoryController@delete')->name('delete');
});

Route::prefix('tag')->name('tag.')->group(function () {
    Route::get('create', 'TagController@add')->name('create');
    Route::post('create', 'TagController@create')->name('create');
    Route::get('index', 'TagController@index')->name('index');
    Route::get('edit', 'TagController@edit')->name('edit');
    Route::post('edit', 'TagController@update')->name('edit');
    Route::get('delete', 'TagController@delete')->name('delete');
});




Route::get('/', function () {
    return view('welcome');
});
Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();
