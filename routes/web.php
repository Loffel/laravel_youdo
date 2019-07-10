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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/register-executor', function(){
    return view('auth.register-exec');
});

Route::prefix('admin')->middleware('auth')->group(function(){
    Route::get('/', 'AdminController@index')->name('admin.index');

    // Служебные
    Route::get('/users/activate/{user_id}', 'AdminController@activateUser')->name('admin.activate_user');
});

Route::prefix('tasks')->middleware('auth')->group(function(){
    Route::get('/', 'TaskController@index')->name('tasks.index');
    Route::get('/new', 'TaskController@create')->name('tasks.create');
    Route::post('/new', 'TaskController@store')->name('tasks.store');
    Route::get('/{id}', 'TaskController@show')->name('tasks.show');
    Route::get('/edit/{id}', 'TaskController@edit')->name('tasks.edit');
    Route::patch('/edit/{id}', 'TaskController@update')->name('tasks.update');
    Route::delete('/delete/{id}', 'TaskController@show')->name('tasks.delete');
});