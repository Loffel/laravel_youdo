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

Route::prefix('admin')->middleware('auth')->name('admin.')->group(function(){
    Route::get('/', 'AdminController@index')->name('index');

    // Служебные
    Route::get('/users/activate/{user_id}', 'AdminController@activateUser')->name('activate_user');
});

Route::prefix('tasks')->middleware('auth')->name('tasks.')->group(function(){
    Route::get('/', 'TaskController@index')->name('index');
    Route::get('/new', 'TaskController@create')->name('create');
    Route::post('/new', 'TaskController@store')->name('store');
    Route::get('/{id}', 'TaskController@show')->name('show');
    Route::get('/edit/{id}', 'TaskController@edit')->name('edit');
    Route::patch('/edit/{id}', 'TaskController@update')->name('update');
    Route::delete('/delete/{id}', 'TaskController@destroy')->name('delete');

    Route::get('/prop/{task_id}/{prop_id}', 'TaskController@selectProposal')->name('select_proposal');
});

Route::prefix('proposals')->middleware('auth')->name('proposals.')->group(function(){
    Route::post('/new', 'ProposalController@store')->name('store');
});