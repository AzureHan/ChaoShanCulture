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

Route::get('/', 'HomeController@index')->name('index');

Route::prefix('/p')->group(function() {
	Route::get('/{id}', 'PostsController@show')->name('posts.show');
	Route::get('/c/{id}', 'PostsController@category')->name('posts.category');
});

Route::prefix('/c')->group(function() {
	Route::get('/', 'CategoriesController@index')->name('categories.index');
});

Route::prefix('/v')->group(function() {

	Route::get('/', 'VideosController@index')->name('videos.index');

});

Route::get('/test', function() {
	
	// factory(App\Models\Post::class, 30)->create();

	// factory(App\Models\User::class, 30)->create();

});

Route::prefix('/onetimes')->namespace('Onetimes')->group(function() {

	Route::get(
		'/create-posts-import-job',
		'CreatePostsImportJob@index'
	)
	->name('create-posts-import-job');

	Route::get(
		'/refresh-categories-div',
		function() {
			\App\Models\Category::refreshDivs();
		}
	);

});