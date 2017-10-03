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

Route::get('/', 'HomeController@show')->name('home');

Auth::routes();

Route::get('login/{provider}', 'Auth\SocialLoginController@redirectToProvider');
Route::get('login/{provider}/callback', 'Auth\SocialLoginController@handleProviderCallback');

Route::get('detail/{linkName}', 'DetailController@getDetail')->name('detail');

Route::group(['middleware' => 'auth'], function(){
	Route::post('like/detail', 'Likes\DetailLikeController@add')->name('detailLike');
	Route::post('like/comment', 'Likes\CommentLikeController@add')->name('commentLike');

	Route::post('comment/child/add', 'Comments\ChildCommentController@add')->name('addChildComment');
	Route::post('comment/detail/add', 'Comments\DetailCommentController@add')->name('addDetailComment');
});

Route::get('comment/detail/{id}', 'Comments\DetailCommentController@all')->name('allDetailComments');
Route::get('comment/{id}/childs', 'Comments\ChildCommentController@all')->name('allChildComments');
