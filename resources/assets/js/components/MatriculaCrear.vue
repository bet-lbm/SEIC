<template>
<div class="row">
	
	<div class="card">
		<div class="card-title">
			<div class="row line-head">
				<h5 class="col-md-6 col-sm-6 col-xs-6"> <i class="fa fa-barcode"></i> <b> CÓDIGO DE MATRICULA :</b>&nbsp;&nbsp;M22-00012</h5>
	            <div class="col-md-6 col-sm-6 col-xs-6">
	                <h5 class="pull-right"><i class="fa fa-calendar"></i>&nbsp;&nbsp;{{ today }}</h5>
	            </div> 
			</div>
        </div>         
		<div class="card-body">
			<div class="row invoce-info line-head">
				<div class="col-md-3">
			        <h3 class="text-center ">
                        <i class="fa fa-graduation-cap"></i><br>SEIC<br><small>CAPACITACIONES</small>
                    </h3>
				</div>
				<div class="col-sm-9 col-md-9 col-xs-6">
                    <address>
                    	<div class="col-md-5">
	                        <br><i class="fa fa-id-card-o"></i><b>  DNI: </b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ fillAlumno.dni }}
	                        <br><b> Nombres: </b>{{ fillAlumno.nombres }}  
	                        <br><b> Apellidos: </b>{{ fillAlumno.apellidos }}
                    	</div>
                    	<div class="col-md-7">
	                        <br><i class="fa fa-home"></i><b> Dirección:</b>&nbsp;&nbsp;{{ fillAlumno.direccion }} 
	                        <br><i class="fa fa-phone"></i> <b> Teléfono:</b>&nbsp;&nbsp;&nbsp;{{ fillAlumno.telefono }}
	                        <br><b> @ e-mail:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ fillAlumno.email }}
                    	</div>
                        <br>
                        <button type="button" class="btn-link pull-right"  @click.prevent="showAlumno()"><i class="fa fa-search"></i></button>
                    </address>
                </div>
			</div>
			<div class="row form-horizontal">
				<br>
				<div class="form-group col-md-8  col-sm-8  col-xs-12">
                    <label class="control-label col-md-3 col-sm-3 col-xs-6">Seleccionar Curso: </label>
                    <div class="col-md-9 col-sm-9 col-xs-6">
                        <select class="form-control" required="required">
                            <option>A</option>
                            <option>B</option>
                        </select>
                    </div>
                </div> 
			</div>
			<div class="row">
				
				<div class="col-xs-5">
	                <div class="table-responsive">
	                    <table class="table">
	                        <tbody>
	                            <tr>
	                                <th style="width:50%">OP. GRAVADA:</th>
	                                <td>S/. 100</td>
	                            </tr>
	                            <tr>
	                                <th>IGV (18%)</th>
	                                <td>S/. 10</td>
	                            </tr>
	                            <tr>
	                              <th>TOTAL:</th>
	                              <td>S/.110</td>
	                            </tr>
	                        </tbody>
	                    </table>
	                </div>
	            </div>
			</div>
		</div>
		


		<div class="card-footer"></div>
	</div>

	<div class="modal" id="show-item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                    </button>
                    <h5 class="modal-title" id="myModalLabel"> Buscar alumno </h5> 
                </div>
                <div class="modal-body">
                    <div class="row top_search">
                        <label class="control-label col-md-3">Buscar: </label>    
                        <div class="input-group col-md-8">
                            <input class="form-control" type="text" v-model="queryString" v-on:keyup="getResults()" placeholder="Nombres Y Apellidos" autofocus="autofocus">
                            <span class="input-group-addon"><i class="fa fa-search"></i></span>
                        </div>
                    </div>
                
                    <table class="table"> 
                        <thead>
                            <tr> 
                                <th>DNI</th>
                                <th>Nombres y Apellidos</th>
                                <th colspan="1">&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr  v-for="alumno in alumnos">
                                <th>{{ alumno.dni }}</th>
                                <th>{{ alumno.nombres }} {{ alumno.apellidos }}</th>
                                <td width="10px">
                                    <button class="btn-link" @click.prevent="selectAlumno(alumno)" title="Seleccionar">
                                    <i class="fa fa-check"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</template>
<script>
export default{
	data(){
		return{
			date: new Date(),
			queryString:'',
			alumnos: [],
			fillAlumno: {'id': '','dni':'','nombres':'','apellidos':'','sexo':'','direccion':'','email':'','telefono':''},
		}
	},
	computed:{
		today: function()
        {
            return this.date.toLocaleString("es-CL", {year: "numeric", month: "numeric",day: "numeric"});
        }
	},
	methods:{
		getResults(){
            var that=this;
            axios.get('/alumnos/search',{params:{queryString:this.queryString}}).then(response=>{
                that.alumnos=response.data.data.data;
            })
        },
        selectAlumno: function(alumno){
        	this.fillAlumno.dni = alumno.dni;
        	this.fillAlumno.nombres = alumno.nombres;
        	this.fillAlumno.apellidos = alumno.apellidos;
        	this.fillAlumno.direccion = alumno.direccion;
        	this.fillAlumno.email = alumno.email;
        	this.fillAlumno.telefono = alumno.telefono;
        	$("#show-item").modal('hide');
            this.queryString = '';
            this.alumnos = '';
        },
		showAlumno: function(){
			$("#show-item").modal('show');
		}
	}
}
</script>