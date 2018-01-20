<template>
	<div class="row">
        <div class="col-md-3">
        	<div class="widget">
              	<h1 class="text-center text-info">
    				<i class="fa fa-clock-o fa-3x"></i>
    				<br>
            		{{ getHora }}
            	</h1>
            	<h4 class="text-center text-info"> {{ getDate }}</h4>
            </div>
        </div>
        <div class="col-md-8 ">
        	<div class="card">
        		<br><h5 class="card-title"><i class="fa fa-lg fa-id-card-o"></i> <em> Ingrese número de DNI:</em></h5>
        		<div class="card-body">
        			<div class="row">
        				<div class="col-md-4">
        					<div class="form-group">
        						<input class="form-control" type="text" placeholder="DNI" autofocus="autofocus" v-model="dni" v-on:keyup="getItem(dni)">
		                    </div>
                        </div>
                        <div class="col-md-8">
                            <table class="table table-sm"> 
                                <thead>
                                    <tr> 
                                        <th style="width: 95%">Curso</th>
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
        					<div class="panel panel-primary">
        						<div class="panel-heading">
	        						<h4 class="panel-title text-center">{{ fillItem.code }}</h4>
        						</div>
        						<div class="panel-body">
		        					<i v-if="fillItem.sexo === ''" class="fa fa-user-circle fa-4x pull-right text-primary"></i>
		        					<i v-if="fillItem.sexo === 'M'" class="fa fa-male fa-4x pull-right text-primary"></i>
		        					<i v-if="fillItem.sexo === 'F'" class="fa fa-female fa-4x pull-right text-primary"></i>
	        						<h4><em>{{ fillItem.nombres }} {{ fillItem.apellidos }}</em> </h4>
	        						<h5 v-if="fillItem.estado === 0" class="text-danger"><b>DEUDA PENDIENTE</b></h5>
        						</div>
        					</div>
        				</div>
        			</div>
        		</div>
        		<div class="card-footer">
        			<div class="row">
						<div class="col-xs-12">
		                    <button class="btn btn-default pull-right" @click.prevent="clean()"><i class="fa fa-fw fa-lg fa-times-circle"></i> Cancelar</button>
		                    <button class="btn btn-success pull-right" style="margin-right: 5px;" @click.prevent="createMatricula()"><i class="fa fa-fw fa-lg fa-check-circle" ></i> Registrar</button>
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
			newItem:{'matricula_id':''},
			fillItem: {'code':'','estado':'','nombres':'','apellidos':'','sexo':''},
		}
	},
	computed:{
		getDate: function()
        {
            return this.date.toLocaleString("es-CL", {year: "numeric", month: "numeric",day: "numeric"});
        },
		getHora:  function(){
        	return this.date.getHours()+':'+this.date.getMinutes()+':'+this.date.getSeconds();
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
            this.newItem.matricula_id = item.code;
            this.fillItem.code = item.code;
            this.fillItem.nombres = item.nombres;
            this.fillItem.apellidos = item.apellidos;
            this.fillItem.sexo = item.sexo;
            this.fillItem.estado = item.estado;
        },
        createMatricula: function(){
        	var input = this.newItem;
            if(input['matricula_id'] == '')
            {
                toastr.warning('Complete todos los campos', {timeOut: 5000});
            }
            else{
                axios.post('/asistencias',input).then(response=>{
                    console.log('que pasa');
                    this.newItem = {'matricula_id':''};
                    this.dni = '';
                    this.items = '';     
                    this.fillItem = {'code':'','estado':'','nombres':'','apellidos':'','sexo':''};
                    toastr.success('Asistencia registrada ', {timeOut: 5000});
                });
            }
        },
        clean: function(){
            this.dni = '';
            this.items = ''; 
            this.fillItem = {'code':'','estado':'','nombres':'','apellidos':'','sexo':''};
        }
	}
}
</script>