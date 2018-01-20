@extends('layouts.base')

@section('content')
	<div class="page-title">
		<div>
	    	<h1><i class="fa fa-lg fa-desktop"></i>&nbsp;Buscar Matricula</h1>
	    	<p>Detalles de Matricula</p>
	  	</div>
	  	<ul class="breadcrumb side">
	    	<li><i class="fa fa-home fa-lg"></i></li>
	      	<li>Matricula</li>
	      	<li class="active"><a href="{{ route('matriculas.create') }}">Buscar </a></li>
	    </ul>
	</div>
	
@endsection