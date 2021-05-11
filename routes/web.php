<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('tasks', 'TasksController');
Route::resource('test_auth', 'TestAuthController');

/**************************************
 * API
 **************************************/
Route::prefix('api')->group(function(){
  //tasks
  Route::post('/apitasks/create_task', 'ApiTasksController@create_task');
  Route::post('/apitasks/update_post', 'ApiTasksController@update_post')->name('apitasks.update_post');
  Route::post('/apitasks/delete_task', 'ApiTasksController@delete_task');
  Route::get('/apitasks/get_tasks', 'ApiTasksController@get_tasks');
  Route::post('/apitasks/get_item', 'ApiTasksController@get_item');
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
