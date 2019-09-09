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

Route::get('/', 'HomeController@welcome')->name('welcome');
Route::get('/home', 'HomeController@index')->middleware('auth')->name('home');
Route::get('/register-executor', function(){
    return view('auth.register-exec');
});

Route::prefix('admin')->middleware('auth')->name('admin.')->group(function(){
    Route::get('/', 'AdminController@index')->name('index');

    // Служебные
    Route::get('/users/activate/{user_id}', 'AdminController@activateUser')->name('activate_user');
});

Route::prefix('tasks')->name('tasks.')->group(function(){
    Route::get('/', 'TaskController@index')->name('index');
    Route::get('/new', 'TaskController@create')->name('create');
    Route::post('/new', 'TaskController@store')->name('store');
    Route::get('/{id}', 'TaskController@show')->name('show');
    Route::get('/edit/{id}', 'TaskController@edit')->name('edit');
    Route::patch('/edit/{id}', 'TaskController@update')->name('update');
    Route::delete('/delete/{id}', 'TaskController@destroy')->name('delete');

    Route::get('/home', 'TaskController@dashboard')->name('dashboard');
    Route::get('/home/proposals/{id}', 'TaskController@proposals')->name('proposals');
    Route::get('/proposal/{task_id}/{prop_id}', 'TaskController@selectProposalView')->name('select_proposal.view');
    Route::post('/proposal/accepted', 'TaskController@selectProposalStore')->name('select_proposal.store');
});

Route::prefix('posts')->name('posts.')->group(function(){
    Route::get('/', 'PostController@index')->name('index');
    Route::get('new', 'PostController@create')->name('create');
    Route::post('new', 'PostController@store')->name('store');
    Route::get('/{id}', 'PostController@show')->name('show');
    Route::get('/edit/{id}', 'PostController@edit')->name('edit');
    Route::patch('/edit/{id}', 'PostController@update')->name('update');
    Route::delete('/delete/{id}', 'PostController@destroy')->name('delete');
});

Route::prefix('proposals')->middleware('auth')->name('proposals.')->group(function(){
    Route::post('/new', 'ProposalController@store')->name('store');
    Route::get('/', 'ProposalController@dashboard')->name('dashboard');
    Route::patch('/update', 'ProposalController@update')->name('update');
    Route::get('/delete/{id}', 'ProposalController@destroy')->name('delete');
});

Route::prefix('messenger')->middleware('auth')->name('messenger.')->group(function(){
    Route::get('/', 'MessengerController@index')->name('index');
    Route::get('/conversation/{id}', 'MessengerController@getMessages')->name('getConversation');
    Route::post('/conversation/send', 'MessengerController@sendMessage')->name('sendMessage');
    
    Route::get('/contacts', 'MessengerController@getContacts')->name('contacts');
});

Route::prefix('profile')->name('profile.')->group(function(){
    Route::get('/settings', 'ProfileController@settingsShow')->middleware('auth')->name('settings.show');
    Route::post('/settings', 'ProfileController@settingsUpdate')->middleware('auth')->name('settings.update');
    Route::get('/{id}', 'ProfileController@show')->name('show');
});

Route::prefix('reviews')->middleware('auth')->name('reviews.')->group(function(){
    Route::get('/', 'ReviewController@index')->name('index');
    Route::post('/new', 'ReviewController@store')->name('store');
    Route::patch('/', 'ReviewController@update')->name('update');
});