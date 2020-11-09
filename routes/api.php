<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/department', 'DepartmentController@show');
Route::get('/department/{id}', 'DepartmentController@detail');

Route::get('/employee', 'EmployeeController@show');
Route::get('/employee/{id}', 'EmployeeController@detail');
Route::post('/employee', 'EmployeeController@store');
Route::put('/employee/{id}', 'EmployeeController@update');
Route::delete('/employee/{id}', 'EmployeeController@destroy');

Route::get('/project', 'ProjectController@show');
Route::get('/project/{id}', 'ProjectController@detail');
Route::post('/project', 'ProjectController@store');
Route::put('/project/{id}', 'ProjectController@update');
Route::delete('/project/{id}', 'ProjectController@destroy');

Route::get('/workson', 'WorksOnController@show');
Route::get('/workson/employee/{id}', 'WorksOnController@findEmpProj');
Route::get('/workson/project/{id}', 'WorksOnController@findProjEmp');
Route::post('/workson', 'WorksOnController@store');
Route::put('/workson/{id}', 'WorksOnController@update');
Route::delete('/workson/{id}', 'WorksOnController@destroy');

