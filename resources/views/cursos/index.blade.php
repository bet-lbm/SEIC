@extends('layouts.base')

@section('content')
	<div class="page-title">
		<div>
	    	<h1><i class="fa fa-laptop"></i> <small> Cursos</small> </h1>
	  	</div>
	  	<div>
	    	<a class="btn btn-primary btn-flat" href="{{ route('cursos.create') }}"><i class="fa fa-lg fa-plus"></i></a>
	 	 </div>
	</div>	
  	<cursos></cursos>     
@endsection