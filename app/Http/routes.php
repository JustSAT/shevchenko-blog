<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

Route::post('/password', 'ExampleController@test');
Route::get('/', 'ExampleController@index');

Route::get('/users', 'ExampleController@users');
Route::post('/posts', 'ExampleController@create');
Route::get('/posts/{id}', 'ExampleController@post');
Route::post('/posts/{id}', 'ExampleController@makeComment');
Route::post('/posts/delete/{id}', 'ExampleController@deletePost');


Route::get('/users/{id}', 'ExampleController@user');

Route::get('/comments', 'ExampleController@comments');
Route::post('/comments/delete/{id}', 'ExampleController@deleteComment');

Route::post('/login', 'ExampleController@login');
Route::get('/logout', 'ExampleController@logout');

Route::get('/signup', function(){
    return view('pages.signup');
});

Route::post('/signup', 'ExampleController@signup');



Route::post('/newpost', 'ExampleController@newpost');
Route::get('/newpost', function () {
    return view('pages.new_post')
        ->with('user_id', \Session::get('user_id'));
});