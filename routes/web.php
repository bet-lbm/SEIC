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
Route::get('/aulas/combo','AulaController@combo');
Route::resource('aulas','AulaController',['except' => ['edit']]);
//---------------------------- ALUMNOS -------------------------------------------
Route::name('alumnos.list')->get('/alumnos/list','AlumnoController@getIndex');
Route::get('/alumnos/search','AlumnoController@search');
Route::resource('alumnos','AlumnoController',['except' => ['edit']]); 
//---------------------------- CURSOS -------------------------------------------
Route::name('cursos.list')->get('/cursos/list','CursoController@getIndex');
Route::get('/cursos/combo','CursoController@combo');
Route::resource('cursos','CursoController',['except' => ['edit']]); 
//-----------------------------Horario-------------------------------------------
Route::name('horarios.list')->get('/horarios/list','HorarioController@getIndex');
Route::resource('horarios','HorarioController',['except'=>['edit']]);

//-----------------------------Tema----------------------------------------------
Route::name('temas.list')->get('/temas/list','TemaController@getIndex');
Route::get('/temas/search','TemaController@search');
Route::get('/temas/combo','TemaController@combo');
Route::get('/temas/get/{id}','TemaController@getTema');
Route::resource('temas','TemaController',['except'=>['edit']]);
Route::get('/horarios/curso/{curso}','HorarioController@findHorario');
//-----------------------------MATRICULA-------------------------------------------
Route::resource('matriculas','MatriculaController',['except' => ['edit']]); 
Route::get('/matriculas/code','MatriculaController@code');

