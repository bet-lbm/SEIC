@extends('layouts.base')

@section('content')
	<div class="page-title">
		<div>
	    	<h1><i class="fa fa-desktop"></i> <small> MATRICULA</small> </h1>
	  	</div>
	  	<div>
	    	<a class="btn btn-link" href="{{ route('alumnos.list') }}"><i class="fa fa-lg fa-th-list"></i></a>
	 	 </div>
	</div>	
  	<addmatricula></addmatricula>     
@endsection