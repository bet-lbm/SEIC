@extends('layouts.base')

@section('content')
	<div class="page-title">
		<div>
	    	<h1><i class="fa fa-calendar"></i> Horarios</h1>
	    	<p>Lista de horarios disponibles</p>
	  	</div>
	  	<div>
	    	<a class="btn btn-primary btn-flat" href="{{ route('horarios.create') }}"><i class="fa fa-lg fa-plus"></i></a>
	 	 </div>
	</div>	
  	<horarios></horarios>
@endsection