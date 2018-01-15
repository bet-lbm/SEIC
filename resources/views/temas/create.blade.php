@extends('layouts.base')

@section('content')
	<div class="page-title">
		<div>
	    	<h1><i class="fa fa-laptop"></i> <small> TEMA </small> </h1>
	  	</div>
	  	<div>
	    	<a class="btn btn-primary btn-flat" href="{{ route('temas.list') }}"><i class="fa fa-lg fa-th-list"></i></a>
	 	 </div>
	</div>	
  	<addtema></addtema>     
@endsection