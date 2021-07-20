<?php
use App\Events\NewComment;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
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

// Route::get('/login', function () {
//     return view('login');
// });

// Route::get('/register', function () {
//     return view('register');
// });

// Route::post('/login', 'UserController@login')->name('user.login');

// Route::post('/register', 'UserController@register')->name('user.register');

// Route::get('/', 'PostController@index')->name('post.list');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', 'HomeController@index')->name('home');

Route::get('post/create','PostController@create')->name('post.create');

Route::post('post/store','PostController@store')->name('post.store');

Route::get('/{post}/post', 'PostController@edit')->name('post.edit')->where('id', '[0-9]');

Route::post('/{post}/post', 'PostController@update')->name('post.update')->middleware('postlimit');

Route::get('/{post}/detail', 'PostController@detail')->name('post.detail');

Route::delete('/{post}/post','PostController@destroy')->name('post.destroy');

Route::get('/newsfeed', 'PostController@getnewsfeed')->name('newsfeed');

Route::get('/search', 'PostController@search')->name('search');

Route::get('/error', 'PostController@search')->name('error');

Route::get('/profile', 'HomeController@profile')->name('user.profile');

Route::get('/{id}/profile', 'HomeController@checkAuthorization')->name('check-authorization');

Route::get('/profile/edit', 'HomeController@editProfile')->name('user.profile.edit');

Route::post('/profile/update', 'HomeController@updateProfile')->name('user.profile.update');

Route::post('/detail/store_comment/{post}', 'HomeController@storeComment')->name('user.comment.store');

Route::post('/{post}/detail/store_reply', 'HomeController@storeReply')->name('user.comment.reply.store');

Route::get('/tags', 'TagController@tagList')->name('tags');

Route::get('{id}/tag/posts', 'TagController@tagPosts')->name('tag.posts');

Route::get('{id}/post/like', 'PostController@countLike')->name('post.like');




