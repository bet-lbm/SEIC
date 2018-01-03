@extends('layouts.base')

@section('content')
	<div class="page-title">
		<div>
	    	<h1><i class="fa fa-user-plus"></i> <small> Alumnos</small> </h1>
	  	</div>
	  	<div>
	    	<a class="btn btn-primary btn-flat" href="{{ route('alumnos.list') }}"><i class="fa fa-lg fa-th-list"></i></a>
	 	 </div>
	</div>	
  	<addalumno></addalumno>     
@endsection