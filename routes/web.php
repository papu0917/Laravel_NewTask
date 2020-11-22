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

Route::group(['prefix' => 'accountbook'], function () {
    Route::get('home', 'AccountbookController@home')->name('accountbook.home');
    Route::get('create', 'AccountbookController@add')->name('accountbook.create');
    Route::post('create', 'AccountbookController@create')->name('accountbook.create');
    Route::get('delete', 'AccountbookController@delete')->name('accountbook.delete');
    Route::get('edit', 'AccountbookController@edit')->name('accountbook.edit');
    Route::post('edit', 'AccountbookController@update')->name('accountbook.edit');
    Route::get('eachYear', 'AccountbookController@eachYear')->name('accountbook.eachYear');
    Route::get('eachAmount', 'AccountbookController@eachAmount')->name('accountbook.eachAmount');
    Route::get('eachAmount/index', 'AccountbookController@amountMonth')->name('accountbook.eachAmount.index');
    Route::get('eachAmount/amountCategory', 'AccountbookController@amountCategory')->name('accountbook.eachAmount.amountCategory');
    Route::get('eachAmount/amountTag', 'AccountbookController@amountTag')->name('accountbook.eachAmount.amountTag');
    Route::get('search/', 'AccountbookController@search')->name('accountbook.search');
    Route::get('search/searchResults', 'AccountbookController@searchResults')->name('accountbook.search.searchResults');
});

Route::group(['prefix' => 'category'], function () {
    Route::get('create', 'CategoryController@add')->name('category.create');
    Route::post('create', 'CategoryController@create')->name('category.create');
    Route::get('index', 'CategoryController@index')->name('category.index');
    Route::get('edit', 'CategoryController@edit')->name('category.edit');
    Route::post('edit', 'CategoryController@update')->name('category.edit');
    Route::get('delete', 'CategoryController@delete')->name('category.delete');
});

Route::group(['prefix' => 'tag'], function () {
    Route::get('tag/create', 'TagController@add')->name('tag.create');
    Route::post('tag/create', 'TagController@create')->name('tag.create');
    Route::get('index', 'TagController@index')->name('tag.index');
    Route::get('tag/edit', 'TagController@edit')->name('tag.edit');
    Route::post('tag/edit', 'TagController@update')->name('tag.edit');
    Route::get('tag/delete', 'TagController@delete')->name('tag.delete');
});




Route::get('/', function () {
    return view('welcome');
});
Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();
