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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/home', 'HomeController@index')->name('home');
Auth::routes();
//---------------------alulas--------------------------------------------------
Route::name('aulas.list')->get('/aulas/list','AulaController@getIndex');
Route::resource('aulas','AulaController',['except' => ['edit']]); 
//---------------------------- ALUMNOS -------------------------------------------
Route::name('alumnos.list')->get('/alumnos/list','AlumnoController@getIndex');
Route::get('/alumnos/search','AlumnoController@search');
Route::resource('alumnos','AlumnoController',['except' => ['edit']]); 
//---------------------------- CURSOS -------------------------------------------
Route::name('cursos.list')->get('/cursos/list','CursoController@getIndex');
Route::resource('cursos','CursoController',['except' => ['edit']]); 
