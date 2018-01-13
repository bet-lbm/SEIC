@extends('layouts.base')

@section('content')
	<div class="page-title">
		<div>
	    	<h1><i class="fa fa-desktop"></i> <small> MATRICULA</small> </h1>
	  	</div>
	  	<div>
	    <ul class="breadcrumb side">
	    	<li><i class="fa fa-home fa-lg"></i></li>
	      	<li>Matricula</li>
	      	<li class="active"><a href="{{ route('matriculas.index') }}">Nueva </a></li>
	    </ul>
	  </div>

	</div>	
  	<addmatricula></addmatricula>     
@endsection