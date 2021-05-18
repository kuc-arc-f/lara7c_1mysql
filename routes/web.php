<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/cms_posts/test', 'CmsPostsController@test');
Route::resource('cms_posts', 'CmsPostsController');
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
 * admin
 **************************************/
Route::prefix('admin')->group(function(){
  Route::get('/', 'admin\HomeController@index');
  //users
  Route::get( '/register', 'admin\AdminUsersController@add');
  Route::get( '/login', 'admin\AdminUsersController@login');
  Route::post( '/logout', 'admin\AdminUsersController@logout');
});
/**************************************
 * API
 **************************************/
Route::prefix('api')->group(function(){
  Route::get('/test/test1', 'api\ApiTestController@test1');
  Route::resource('test', 'api\ApiTestController');
  //users
//  Route::get('/users/test', 'api\ApiUsersController@test');
  Route::post('/users/login', 'api\ApiUsersController@login');
  Route::post('/users/add', 'api\ApiUsersController@add');
  //tags
  Route::get('/tags/list', 'api\ApiTAgsController@list');
  Route::get('/category/list', 'api\ApiCategoryController@list');
  //book
  Route::post('/books/delete', 'api\ApiBooksController@delete');
  Route::post('/books/update', 'api\ApiBooksController@update');
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
  //admin_users
  Route::post('/admin_users/login', 'api\admin\ApiAdminUsersController@login');
  Route::post('/admin_users/add', 'api\admin\ApiAdminUsersController@add');
});

//Auth::routes();
Route::get( '/register', 'UsersController@add');
Route::get( '/login', 'UsersController@login');
Route::post( '/logout', 'UsersController@logout');
Route::get('/home', 'HomeController@index')->name('home');
