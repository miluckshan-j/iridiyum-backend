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
});

Route::get('/login','UserController@login');
Route::post('/register','UserController@register');
Route::put('/user/{id}','UserController@editUserDetails');
Route::put('/user/{id}/change-password','UserController@changePassword');
Route::get('/search','UserController@searchUser');

Route::post('/group','GroupController@createGroup');
Route::put('/group/{id}','GroupController@editGroup');
Route::delete('/group/{id}','GroupController@deleteGroup');
Route::post('/group/{id}/connection/{cid}','GroupController@addConnectionToGroup');
Route::delete('/group/{id}/connection/{cid}','GroupController@deleteConnectionFromGroup');
Route::get('/group/{id}/connection','GroupController@getConnectionInGroup');

Route::post('/user/{id}/connection/{cid}','ConnectionController@addConnection');
Route::get('/user/{id}/connection','ConnectionController@getConnections');
Route::delete('/user/{id}/connection/{cid}','ConnectionController@deleteConnection');

Route::get('/user/{id}/post','PostController@getUserPosts');
Route::get('/group/{id}/post','PostController@getGroupPosts');
Route::post('/post','PostController@createPost');
Route::get('/post/{id}','PostController@getPost');
Route::delete('/post/{id}','PostController@deletePost');
Route::put('/post/{id}','PostController@editPost');

Route::post('/post/{id}/comment','CommentController@addComment');
Route::put('/post/{id}/comment/{cid}','CommentController@editComment');
Route::delete('/post/{id}/comment/{cid}','CommentController@deleteComment');
Route::get('/post/{id}/comment','CommentController@getCommentsForPost');
