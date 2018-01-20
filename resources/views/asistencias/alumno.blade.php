@extends('layouts.base')

@section('content')
	<div class="page-title">
		<div>
	    	<h1><i class="fa fa-lg fa-fw fa-clock-o"></i>&nbsp;Consulta de Asistencia</h1>
	    	<p>Busqueda de asistencias de alumno</p>
	  	</div>
	  	<ul class="breadcrumb side">
	    	<li><i class="fa fa-home fa-lg"></i></li>
	      	<li>Consulta</li>
	      	<li class="active"><a href="{{ route('asistencias.create') }}">Asistencia</a></li>
	    </ul>
	</div>
	<asistencias-alumno></asistencias-alumno>
@endsection