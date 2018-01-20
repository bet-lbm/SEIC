@extends('layouts.base')

@section('content')
	<div class="page-title">
		<div>
	    	<h1><i class="fa fa-certificate"></i>&nbsp;Certificados</h1>
	    	<p>Registrar entrega de Certificados</p>
	  	</div>
	  	<ul class="breadcrumb side">
	    	<li><i class="fa fa-home fa-lg"></i></li>
	      	<li>Procesos</li>
	      	<li class="active"><a href="{{ route('certificados.list') }}">Certificados</a></li>
	    </ul>
	</div>
	<addcertificado></addcertificado>
@endsection