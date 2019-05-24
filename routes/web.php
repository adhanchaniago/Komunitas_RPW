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

Auth::routes(); //Route Auth

/**
 * Route Landing Page
 */
Route::get('/landing','LandingPageController@index')->name('landing');

/**
 * Route Login Lewat Sosial Media
 */
Route::get('auth/{provider}', 'SocialLoginController@redirectToProvider');
Route::get('auth/{provider}/callback', 'SocialLoginController@handleProviderCallback');

/**
 * Route Middleware Auth
 */
Route::middleware(['auth'])->group(function (){
	/**
	 * Route Home
	 */
	Route::get('/home', 'HomeController@index')->name('home');
	Route::get('/', 'HomeController@index');
	Route::get('/new', 'HomeController@newPost')->name('home.newPost');

	/**
	 * Route Admin
	 */
	Route::prefix('admin')->group(function(){
		Route::get('/', 'AdminController@index')->name('admin.index');
		Route::get('users', 'AdminController@UserIndex')->name('user.index');
		Route::get('comunity/create', 'AdminController@CommunityUpdate')->name('community.create');
		Route::get('comunity', 'AdminController@CommunityIndex')->name('community.index');
		Route::get('comunity/{id}', 'AdminController@CommunityShow')->name('community.show');
		Route::get('comunity/{id}/edit', 'AdminController@CommunityEdit')->name('community.edit');
		Route::PUT('comunity/{id}/update', 'AdminController@CommunityUpdate')->name('community.update');
		Route::delete('comunity/{id}/delete', 'AdminController@CommunityDestroy')->name('community.destroy');
		Route::get('comunity/store', 'AdminController@CommunityUpdate')->name('community.store');
	});

	/**
	 * Route Post
	 */
	Route::prefix('posts')->group(function(){
		Route::get('create','PostController@create')->name('posts.create');
		Route::get('{title}','PostController@show')->name('posts.show');
		Route::get('{title}/edit','PostController@edit')->name('posts.edit');
		Route::delete('{id}/delete','PostController@delete')->name('posts.delete');
		Route::PUT('{title}','PostController@update')->name('posts.update');
		Route::POST('/','PostController@store')->name('posts.store');
	});
	Route::post('/ajaxRequest', 'PostController@ajaxRequest')->name('ajaxRequest');


	/**
	 * Route Comment
	 */
	Route::prefix('comment')->group(function(){
		Route::POST('/','CommentController@store')->name('comments.store');
	});

	// Route::post('posts/{id}/act', 'HomeController@actOnPost');
	
	/**
	 * Route Profile User
	 */
	Route::prefix('profile')->group(function(){
		Route::get('{username}','UserController@show')->name('users.show');
		Route::PUT('{username}/changePassword','UserController@changePassword')->name('users.changePassword');
		Route::PUT('{username}/update','UserController@update')->name('users.update');
		Route::delete('{username}/delete','UserController@destroy')->name('users.delete');
	});

	/**
	 * Route Komunitas
	 */
	Route::prefix('community')->group(function(){
		Route::get('{name}','CommunityController@show')->name('comunity.show');
		Route::get('{name}/unfollow','CommunityController@unfollow')->name('comunity.unfollow');
		Route::get('{name}/follow','CommunityController@follow')->name('comunity.follow');
	});

	/**
	 * Route Event
	 */
	Route::prefix('event')->group(function(){
		Route::get('{name}/create','EventController@create')->name('event.create');
		Route::POST('{name}/store','EventController@store')->name('event.store');
	});
});


