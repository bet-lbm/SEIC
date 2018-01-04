@extends('layouts.base')

@section('content')
	<div class="page-title">
	  <div>
	    <h1><i class="fa fa-university" aria-hidden="true"></i> Mantenimiento de Aulas</h1>
	  </div>
	  <div>
	    <ul class="breadcrumb side">
	      <li><i class="fa fa-home fa-lg"></i></li>
	      <li>Mantenimiento</li>
	      <li class="active"><a href="{{ route('aulas.list') }}">Aulas </a></li>
	    </ul>
	  </div>
	</div>	
  	<aulas></aulas>     
@endsection