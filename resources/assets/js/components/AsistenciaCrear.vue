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
        						<input class="form-control" type="text" placeholder="DNI" autofocus="autofocus" v-model="dni" v-on:keyup="getAlumno(dni)">
		                    </div>
        				</div>
        				<div class="col-md-8">
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
		                    <button class="btn btn-default pull-right"><i class="fa fa-fw fa-lg fa-times-circle"></i> Cancelar</button>
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
        getAlumno: function(dni){
            var that=this;
            axios.get('/matriculas/alumno/'+dni).then(response=>{
                that.newItem.matricula_id = response.data.code;
                that.fillItem.code=response.data.code;
                that.fillItem.nombres=response.data.nombres;
                that.fillItem.apellidos=response.data.apellidos;
                that.fillItem.estado = response.data.estado;
                that.fillItem.sexo = response.data.sexo;
            })
        },
        createMatricula: function(){
        	var input = this.newItem;
            if(input['matricula_id'] == '')
            {
                toastr.warning('Complete todos los campos', {timeOut: 5000});
            }
            else{
                axios.post('/asistencia',input).then(response=>{
                    console.log('que pasa');
                    this.newItem = {'matricula_id':''};
                    this.dni = '';
                    toastr.success('Asistencia registrada '+this.fillItem.nombres, {timeOut: 5000});
                });
            }
        }
	}
}
</script>