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

Auth::routes();
Route::get('/', 'HomeController@index')->name('home');

// Todos API
Route::get('todos', 'TodoController@index')->name('todo.index')->middleware('auth');
Route::post('todos', 'TodoController@store')->name('todo.store')->middleware('auth');
Route::put('todos/{todo}', 'TodoController@update')->name('todo.update')->middleware('auth');
Route::delete('todos/{todo}', 'TodoController@destroy')->name('todo.complete')->middleware('auth');
