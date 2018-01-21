<template>
	<div class="row">
        <div class="col-md-4">
        	<div class="card">
                <p class="card-title text-center"><i class="fa fa-user-circle-o fa-5x text-info"></i></p>
                <div class="card-body">
                    <div class="row">
                        <div class=" col-md-10 col-md-offset-1">
                            <h5><em>Ingrese número de DNI:</em></h5>  
                            <div class="form-group">
                                <input class="form-control" type="text" placeholder="DNI" autofocus="autofocus" v-model="dni" v-on:keyup="getItem(dni)">
                            </div>
                        </div>
                    </div>
                    <table class="table"> 
                        <thead>
                            <tr>
                                <th style="width: 95%">Cursos</th>
                                <th colspan="1">&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr  v-for="item in items">
                                <td>{{ item.nombre }}</td>
                                <td width="10px">
                                    <button class="btn-link btn-xs" title="Seleccionar" @click.prevent="selectItem(item)"><i class="fa fa-check" aria-hidden="true"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>            	
            </div>
        </div>
        <div class="col-md-8 ">
        	<div class="card">
                <div class="card-title">
                    <p class="line-head"><i class="fa fa-barcode"></i><b> CÓDIGO DE MATRICULA: </b>&nbsp;&nbsp;{{ fillItem.code }}</p>
                </div> 
        		<div class="card-body">
                    <div class="row invoce-info line-head">
                        <div class="col-sm-8 col-md-8 col-xs-6">
                            <b>  DNI: </b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ fillItem.dni }}
                            <br><b> Nombres y Apellidos: </b><em>{{ fillItem.nombres }} {{ fillItem.apellidos }}</em>
                            <br><p v-if="fillItem.estado === 0" class="text-danger"><b>DEUDA PENDIENTE</b></p>
                        </div>
                        <div class="col-md-4">
                            <i class="col-md-4 fa fa-3x fa-graduation-cap"></i>
                            <h5 class="col-md-8">
                                SEIC<br><small>CAPACITACIONES</small>
                            </h5>
                        </div>
                    </div>
        			
                        <table class="table table-hover" role="grid"> 
                            <thead>
                                <tr>
                                    <th> N°</th>
                                    <th style="width: 85%">Fecha - Hora</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr  v-for="(asistencia, index) in asistencias">
                                    <td>{{ index + 1}}</td>
                                    <td>{{ asistencia.created_at }}</td>
                                </tr>
                            </tbody>
                        </table>
        		
        		</div>
        		<div class="card-footer">
        			<div class="row">
						<div class="col-xs-12">
		                    <button class="btn btn-default pull-right" @click.prevent="clean()"><i class="fa fa-fw fa-lg fa-times-circle"></i> Cancelar</button>
		                    <button class="btn btn-success pull-right" style="margin-right: 5px;"><i class="fa fa-fw fa-lg fa-print"></i> Imprimir</button>
		                </div>
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
			dni: '',
            items:[],
            asistencias:[],
			fillItem: {'code':'','estado':'','nombres':'','apellidos':'','dni':''},
		}
	},
	methods:{
        getItem: function(dni){
            var that=this;
            axios.get('/matriculas/alumno/'+dni).then(response=>{
                that.items = response.data;
            })
        },
        selectItem: function(item){
            this.fillItem.code = item.code;
            this.fillItem.nombres = item.nombres;
            this.fillItem.apellidos = item.apellidos;
            this.fillItem.estado = item.estado;
            this.fillItem.dni = item.dni;
            this.getAsistencias(item.code);
        },
        getAsistencias: function(code){
        	var that = this;
            axios.get('/asistencias/search/'+code).then(response=>{
                that.asistencias = response.data;
            })
        },
        clean: function(){
            this.dni = '';
            this.items = ''; 
            this.asistencias = '';
            this.fillItem = {'code':'','estado':'','nombres':'','apellidos':'','dni':''};
        }
	}
}
</script>