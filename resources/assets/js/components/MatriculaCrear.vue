<template>
<div class="row">
	
	<div class="card">
		<div class="card-title">
			<div class="row line-head">
				<h5 class="col-md-6 col-sm-6 col-xs-6"> <i class="fa fa-barcode"></i> <b> CÓDIGO DE MATRICULA :</b>&nbsp;&nbsp;{{ newMatricula.code }}</h5>
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
	                        <br><i class="fa fa-phone"></i><b> Teléfono:</b>&nbsp;&nbsp;&nbsp;{{ fillAlumno.telefono }}
	                        <br><b> @ e-mail:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ fillAlumno.email }}
                    	</div>
                        <br>
                        <button type="button" class="btn-link pull-right"  @click.prevent="showAlumno()"><i class="fa fa-search"></i></button>
                    </address>
                </div>
			</div>
			<div class="row form-horizontal">
				<br>
				<div class="form-group col-md-8 col-sm-8 col-xs-12">
                    <label class="control-label col-md-2 col-sm-2 col-xs-6">Curso: </label>
                    <div class="col-md-8 col-sm-8 col-xs-6">
                        <select class="form-control" v-model="curso" required="required" @change="getHorario(curso)">
                            <option v-for="curso in cursos" :value="curso.id">{{ curso.nombre }}</option>
                        </select>
                    </div>
                    <div class="col-md-8 col-md-offset-2 table-sm">
	                    <table class="table table-sm"> 
	                        <thead>
	                            <tr> 
	                                <th style="width: 35%">Dia</th>
	                                <th style="width: 35%">Horario</th>
	                                <th>Aula</th>
	                                <th colspan="1">&nbsp;</th>
	                            </tr>
	                        </thead>
	                        <tbody>
	                            <tr  v-for="horario in horarios">
	                                <td>{{ horario.dia }}</td>
	                                <td>{{ horario.hora_inicio }} - {{ horario.hora_fin }}</td>
	                                <td>{{ horario.aula_id }}</td>
	                                <td width="10px">
	                                    <button class="btn-link" title="Seleccionar" @click.prevent="selectHorario(horario)"><i class="fa fa-calendar-check-o" aria-hidden="true"></i>
	                                    </button>
	                                </td>
	                            </tr>
	                        </tbody>
	                    </table>
                    </div>
                </div> 
				<div class="col-md-4 col-xs-12 form-horizontal">
                    <h5 class="text-primary"><b><i class="fa fa-clock-o"></i>&nbsp;&nbsp;{{ H }}</b></h5>
                    <table class="table">
                        <tbody>
                            <tr>
                                <th style="width:50%">COSTO DE CURSO:</th>
                                <td class="input-group">
                            		<span class="input-group-addon">S/.</span>
		                            <input  class="form-control" type="text" v-model="newMatricula.precioCurso">
		                        </td>
                            </tr>
                            <tr>
                                <th>ADELANTO / PAGO:</th>
                                <td class="input-group">
                            		<span class="input-group-addon">S/.</span>
		                            <input  class="form-control" type="text" v-model="newMatricula.pago" v-on:keyup="setEstado()">
		                        </td>
                            </tr>
                            <tr>
                              	<th>SALDO:</th>
                              	<td>S/. {{ newMatricula.precioCurso - newMatricula.pago }}</td>
                            </tr>
                        </tbody>
                    </table>
	            </div>
			</div>
		</div>
		<div class="card-footer">
			<div class="row no-print">
                <div class="col-xs-12">
                    <button class="btn btn-success pull-right" @click.prevent="createMatricula()"><i class="fa fa-credit-card"></i> Guardar Matricula</button>
                    <button class="btn btn-default pull-right" style="margin-right: 5px;"><i class="fa fa-print"></i>Imprimir</button>
                </div>
            </div>
		</div>
	</div>

	<div class="modal" id="show-item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                    </button>
                    <h5 class="modal-title" id="myModalLabel"><i class="fa fa-user-circle-o"></i> ALUMNOS</h5> 
                </div>
                <div class="modal-body">
                    <div class="row form-horizontal top_search line-head">
                        <label class="control-label col-md-3"> Buscar: </label>    
                        <div class="input-group col-md-7">
                            <input class="form-control" type="text" v-model="queryString" v-on:keyup="getResults()" placeholder="Nombres y apellidos" autofocus="autofocus">
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
			curso:'',
			H:'',
			alumnos: [],
			cursos:[],
			horarios:[],
			fillAlumno: {'id': '','dni':'','nombres':'','apellidos':'','sexo':'','direccion':'','email':'','telefono':''},
			newMatricula:{'code':'','alumno_id':'','horario_id':'','precioCurso':'','pago':'','fecha':'','estado':'','habilitado':''},
		}
	},
	computed:{
		today: function()
        {
            return this.date.toLocaleString("es-CL", {year: "numeric", month: "numeric",day: "numeric"});
        }
	},
	created(){
		this.getCode();
		this.getCurso();
		this.dateFormat();
	},
	methods:{
		createMatricula: function(){
			var input = this.newMatricula;
			if((input['alumno_id'] == '')||(input['horario_id'] == '')||(input['fecha'] == '')||(input['pago'] == '')){
                    toastr.warning('Complete todos los campos', {timeOut: 5000});
            }
            else{
                axios.post('/matriculas',input).then(response => {            
                    toastr.success('Matricula Realizada',{timeOut: 5000});
                    this.getCode();
	                this.newMatricula= {'code':'','alumno_id':'','horario_id':'','precioCurso':'','pago':'','fecha':'','estado':'','habilitado':''},
	                this.fillAlumno = {'id': '','dni':'','nombres':'','apellidos':'','sexo':'','direccion':'','email':'','telefono':''};
	                this.horarios=[];
	                this.curso=[];
	                this.H = '';
                });
            };
		},
		dateFormat: function() {
            let date = new Date(this.date);
            this.newMatricula.fecha = date.getFullYear() + '-' + ('0' + (date.getMonth()+1)).slice(-2) + '-'+ ('0' + date.getDate()).slice(-2);
        },
        getCode:function(){
        	this.newMatricula.habilitado = true;
        	var that =  this;
        	axios.get('/matriculas/code').then( function (response) {
                that.newMatricula.code = response.data;
            });
        },
		getCurso: function(){
			var that=this;
			axios.get('/cursos/combo').then(function(response){
				that.cursos=response.data;
			});
		},
		getHorario: function(curso){
			var that=this;
			axios.get('/horarios/curso/'+curso).then(function(response){
				that.horarios=response.data;
			});
		},
		getResults(){
            var that=this;
            axios.get('/alumnos/search',{params:{queryString:this.queryString}}).then(response=>{
                that.alumnos=response.data.data.data;
            })
        },
        selectAlumno: function(alumno){
        	this.newMatricula.alumno_id = alumno.id;
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
        selectHorario: function(horario){
        	this.newMatricula.horario_id = horario.id;
        	this.H = horario.dia + ' / ' + horario.hora_inicio + ' - ' + horario.hora_fin ;
        },
        setEstado: function(){
        	var saldo = this.newMatricula.precioCurso - this.newMatricula.pago; 	
        	if (saldo == 0) 
        	{
        		this.newMatricula.estado = true;
        	} 
        	else 
        	{
        		this.newMatricula.estado = false;
        	}
        },
		showAlumno: function(){
			$("#show-item").modal('show');
		}
	}
}
</script>