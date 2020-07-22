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
// Route::get('category', 'CategoryController@index');
// Route::post('category','CategoryController@store');
// Route::get('/category','CategoryController@show');
// Route::resource('category', 'CategoryController');
// Route::get('category/{$id}','CategoryController@show');
Route::get('category', 'CategoryController@index');
Route::post('category', 'CategoryController@store');
Route::post('category/childs', 'CategoryController@MainPage');
Route::get('category/childs', 'CategoryController@MainPage');
Route::get('category/{id}', 'CategoryController@edit');
Route::delete('category/{id}', 'CategoryController@destroy');
Route::put('category/{id}','CategoryController@update');