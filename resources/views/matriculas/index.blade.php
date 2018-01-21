@extends('layouts.base')

@section('content')
	<div class="page-title">
		<div>
	    	<h1><i class="fa fa-lg fa-desktop"></i>&nbsp;Matriculas</h1>
	    	<p>Detalles de Matricula</p>
	  	</div>
	  	<ul class="breadcrumb side">
	    	<li><i class="fa fa-home fa-lg"></i></li>
	      	<li>Matricula</li>
	      	<li class="active"><a href="{{ route('matriculas.list') }}">Listar </a></li>
	    </ul>
	</div>
	<matriculas></matriculas>
@endsection