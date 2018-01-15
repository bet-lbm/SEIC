@extends('layouts.base')

@section('content')
	<div class="page-title">
		<div>
	    	<h1><i class="fa fa-users"></i> <small>TEMAS</small> </h1>
	  	</div>
	  	<div>
	    	<a class="btn btn-primary btn-flat" href="{{ route('temas.create') }}"><i class="fa fa-lg fa-plus"></i></a>
	 	 </div>
	</div>	
  	<temas></temas>
@endsection