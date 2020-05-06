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
	})->name('home');


	Route::post('signup','UserController@postSignUp');

	Route::get('account',[
		'uses' => 'UserController@getAccount',
		'as' => 'account']
		);

	Route::get('account.image/(filename)',[
		'uses' => 'UserController@getUSerImage',
		'as' => 'account.image']
		);
	Route::post('account.save',[
		'uses' => 'UserController@postSaveAccount',
		'as' => 'account.save']
		);

	Route::get('hash',[
		'uses' => 'PostController@getDashBoard',
		'as' => 'hash']
		);

	Route::post('sign_in',[
		'uses' => 'UserController@postSignin',
		'as' => 'signin']

);
Route::post('createpost',[
		'uses' => 'PostController@postCreatePost',
		'as' => 'createpost']

);
Route::get('post.delete/{post_id}',[
		'uses' => 'PostController@getDeletePost',
		'as' => 'post.delete']

);
Route::get('/log',[
		'uses' => 'UserController@getLogout',
		'as' => 'logout']

);

Route::post('/edit',[
		'uses' => 'PostController@postEditpost',
		'as' => 'edit']

);
Route::post('/like',[
		'uses' => 'PostController@postLikePost',
		'as' => 'like']

);




