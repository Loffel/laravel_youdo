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
Route::get('/contacts', 'HomeController@contacts')->name('contacts');

Route::get('/notifications/{id}', 'HomeController@markOne')->middleware('auth')->name('notifications.markOne');
Route::get('/notifications', 'HomeController@markAll')->middleware('auth')->name('notifications.markAll');

Route::get('/register-executor', function(){
    return view('auth.register-exec');
});

Route::prefix('admin')->middleware('auth')->name('admin.')->group(function(){
    // Служебные
    Route::get('/users/activate/{user_id}', 'AdminController@activateUser')->name('activateUser');
    Route::get('/proposals/payout/{proposal_id}', 'AdminController@payoutProposal')->name('payoutProposal');
    Route::get('/proposals/refund/{proposal_id}', 'AdminController@refundProposal')->name('refundProposal');
});

Route::prefix('dashboard')->middleware('auth')->group(function(){
    Route::get('/tasks', 'TaskController@dashboard')->name('tasks.dashboard');
    Route::get('/tasks/new', 'TaskController@create')->name('tasks.create');
    Route::get('/tasks/edit/{id}', 'TaskController@edit')->name('tasks.edit');
    Route::get('/tasks/{id}', 'TaskController@proposals')->name('tasks.proposals');

    Route::get('/proposals', 'ProposalController@dashboard')->name('proposals.dashboard');

    Route::get('/posts/new', 'PostController@create')->name('posts.create');
    Route::get('/posts/edit/{id}', 'PostController@edit')->name('posts.edit');

    Route::get('/messenger', 'MessengerController@index')->name('messenger.index');

    Route::get('/admin', 'AdminController@index')->name('admin.index');

    Route::get('/settings', 'ProfileController@settingsShow')->name('profile.settings.show');

    Route::get('/', 'HomeController@index')->name('home');

    Route::get('/reviews', 'ReviewController@index')->name('reviews.index');
});

Route::prefix('tasks')->name('tasks.')->group(function(){
    Route::get('/', 'TaskController@index')->name('index');
    Route::post('/new', 'TaskController@store')->name('store');
    Route::get('/{id}', 'TaskController@show')->name('show');
    Route::patch('/edit/{id}', 'TaskController@update')->name('update');
    Route::delete('/delete/{id}', 'TaskController@destroy')->name('delete');
    Route::get('/close/{id}', 'TaskController@close')->name('close');

    Route::get('/proposal/{task_id}/{prop_id}', 'TaskController@selectProposalView')->name('select_proposal.view');
    Route::post('/proposal/accepted', 'TaskController@selectProposalStore')->name('select_proposal.store');
});

Route::prefix('posts')->name('posts.')->group(function(){
    Route::get('/', 'PostController@index')->name('index');
    Route::post('new', 'PostController@store')->name('store');
    Route::get('/{id}', 'PostController@show')->name('show');
    
    Route::patch('/edit/{id}', 'PostController@update')->name('update');
    Route::delete('/delete/{id}', 'PostController@destroy')->name('delete');
});

Route::prefix('proposals')->middleware('auth')->name('proposals.')->group(function(){
    Route::post('/new', 'ProposalController@store')->name('store');
    Route::patch('/update', 'ProposalController@update')->name('update');
    Route::get('/delete/{id}', 'ProposalController@destroy')->name('delete');
});

Route::prefix('messenger')->middleware('auth')->name('messenger.')->group(function(){
    Route::get('/conversation/{id}', 'MessengerController@getMessages')->name('getConversation');
    Route::post('/conversation/send', 'MessengerController@sendMessage')->name('sendMessage');
    
    Route::get('/contacts', 'MessengerController@getContacts')->name('contacts');
});

Route::prefix('profile')->name('profile.')->group(function(){
    Route::post('/settings', 'ProfileController@settingsUpdate')->middleware('auth')->name('settings.update');
    Route::get('/{id}', 'ProfileController@show')->name('show');
});

Route::prefix('reviews')->middleware('auth')->name('reviews.')->group(function(){
    Route::post('/new', 'ReviewController@store')->name('store');
    Route::patch('/', 'ReviewController@update')->name('update');
});