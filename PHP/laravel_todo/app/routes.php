<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/tasks', ["as"=>"home", "uses"=>"TasksController@index"]);
Route::post('/tasks', "TasksController@store");
Route::get('/tasks/{id}', "TasksController@show")->where('id', '\d+');

Route::get('{username}/tasks', "UserTasksController@index");

Route::get('{username}/tasks/{id}', ["as"=>"user.tasks.show", "uses"=>"UserTasksController@show"]);

// Route::get('{username}/tasks/{id}', function($username, $id) {
//   // $user = User::whereUsername($username)->first();
//   // $task = $user->tasks()->findOrFail($id);
//   // return View::make('tasks.show', compact('task'));

//   $user = User::with('tasks')->whereUsername($username)->first();
//   // return $user;
//   $task = $user->tasks;

//   return View::make('tasks.show', compact('user', 'task'));
// });