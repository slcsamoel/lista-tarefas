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


Route::get('/', 'HomeController@index' )->name('index');

Route::fallback(function(){
    return view('404');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Rotas de Tasks
Route::resource('tasks', TaskController::class);




