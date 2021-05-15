<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('tags', 'TagsController');
Route::resource('category', 'CategoryController');
Route::get('/tasks/test1', 'TasksController@test1');
Route::get('/tasks/test', 'TasksController@test');
Route::resource('tasks', 'TasksController');
Route::get('/test_auth/test_flash', 'TestAuthController@test_flash');
Route::get('/test_auth/test_session', 'TestAuthController@test_session');
Route::get('/test_auth/test1', 'TestAuthController@test1');
Route::resource('test_auth', 'TestAuthController');
Route::resource('books', 'BooksController');

/**************************************
 * API
 **************************************/
Route::prefix('api')->group(function(){
  Route::get('/test/test1', 'api\ApiTestController@test1');
  Route::resource('test', 'api\ApiTestController');
  Route::get('/tags/list', 'api\ApiTAgsController@list');
  Route::get('/category/list', 'api\ApiCategoryController@list');
  //book
  Route::post('/books/delete', 'api\ApiBooksController@delete');
  Route::post('/books/update', 'api\ApiBooksController@update');
//  Route::post('/books/get_item', 'api\ApiBooksController@get_item');
  Route::post('/books/create', 'api\ApiBooksController@create');    
  Route::get('/books/show', 'api\ApiBooksController@show');
  Route::get('/books/list', 'api\ApiBooksController@list');
  Route::resource('books', 'api\ApiBooksController' );    
  //tasks
  Route::post('/tasks/delete', 'api\ApiTasksController@delete');
  Route::post('/tasks/update', 'api\ApiTasksController@update');
  Route::get( '/tasks/show', 'api\ApiTasksController@show');
  Route::get( '/tasks/list', 'api\ApiTasksController@list');
  Route::post('/tasks/new', 'api\ApiTasksController@new');
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
