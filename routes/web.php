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
Route::name('registro')->get('/registro', function () {
    return view('registro');
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
Route::name('cursos.reporte')->get('/cursos/reporte','CursoController@getReporte');
Route::get('/cursos/reporte/{id}','CursoController@alumnos_curso');
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
Route::name('matriculas.list')->get('/matriculas/list','MatriculaController@getIndex');
Route::get('/matriculas/alumno/{dni}','MatriculaController@getAlumno');
Route::get('/matriculas/code','MatriculaController@code');
Route::resource('matriculas','MatriculaController',['except' => ['edit']]); 

//-------------------------------------NOTAS----------------------------------------
Route::name('notas.list')->get('/notas/list','NotaController@index');
Route::get('/notas/combo/{dni}','NotaController@combo');
Route::name('notas.reporte')->get('/notas/reporte','NotaController@getReporte');
Route::get('/notas/reporte/{id}','NotaController@notas_curso');
Route::resource('notas','NotaController',['except' => ['edit','update','destroy']]); 

// ************** ASISTENCIA *******************
Route::name('asistencias.alumno')->get('/asistencias/alumno','AsistenciaController@getIndexAlumno');
Route::get('/asistencias/search/{code}','AsistenciaController@search');
Route::resource('asistencias','AsistenciaController',['only' => ['create','store']]); 
//---------------------------------Certificado---------------------------------------
Route::name('certificados.list')->get('/cerificados/list','CertificadoController@getIndex');
Route::get('/certificados/combo/{dni}','CertificadoController@combo');
Route::resource('certificados','CertificadoController',['except'=>['edit','update','destroy']]);

