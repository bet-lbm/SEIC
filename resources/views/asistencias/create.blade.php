@extends('layouts.base')

@section('content')
	<div class="page-title">
		<div>
	    	<h1><i class="fa fa-lg fa-fw fa-clock-o"></i>&nbsp;Asistencia</h1>
	    	<p>Registrar asistencia de alumnos</p>
	  	</div>
	  	<ul class="breadcrumb side">
	    	<li><i class="fa fa-home fa-lg"></i></li>
	      	<li>Procesos</li>
	      	<li class="active"><a href="{{ route('asistencia.create') }}">Asistencia</a></li>
	    </ul>
	</div>
	<addasistencia></addasistencia>
@endsection