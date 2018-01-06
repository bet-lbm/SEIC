<template>
	<div class="row">
    <div class="col-md-10 col-sm-12 col-xs-12 col-md-offset-1">
        <div class="card">
            <h4 class="card-title line-head"><i class="fa fa-laptop"></i> REGISTRAR NUEVO HORARIO</h4>
            <form class="form-horizontal">
                <div class="card-body">
                    <div class="form-group">
                        <label class="control-label col-md-3">DIAS</label>
                        <div class="col-md-8">
                            <input class="form-control" type="text" placeholder="LUNES - MIERCOLES - VIERNES " required="required" v-model="newItem.dia" autofocus="autofocus">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">HORA INICIO</label>
                        <div class="col-md-8">
                            <input class="form-control col-md-8" type="text" placeholder="9:00 AM" required="required"  v-model="newItem.hora_inicio" autofocus="autofocus">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">HORA FIN</label>
                        <div class="col-md-8">
                            <input class="form-control col-md-8" type="text" placeholder="10:00 AM" required="required" v-model="newItem.hora_fin" autofocus="autofocus">
                        </div>
                    </div>
                    <div class="form-group">
                    	<label class="control-label col-md-3">AULA</label>
                    	<div class="col-md-8">
                    		<select class="form-control" v-model="newItem.aula_id" required="required" autofocus="autofocus">
                    			<option v-for="aula in aulas" :value="aula.id">{{ aula.numero_aula }}</option>
                    		</select>
                    	</div>	
                    </div>
                    <div class="form-group">
                    	<label class="control-label col-md-3">CURSO</label>
                    	<div class="col-md-8">
                    		<select class="form-control" v-model="newItem.curso_id" required="required" autofocus="autofocus">
                    			<option v-for="curso in cursos" :value="curso.id">{{ curso.nombre }}</option>
                    		</select>
                    	</div>	
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-md-8 col-md-offset-4">
                            <button class="btn btn-primary icon-btn" type="button" @click.prevent="createItem()" ><i class="fa fa-fw fa-lg fa-check-circle"></i>Registrar</button>&nbsp;&nbsp;&nbsp;<button class="btn btn-default icon-btn" type="button" @click.prevent="clean()"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</button>
                        </div>
                    </div>
                </div>
            </form> 
             
        </div>
    </div>
</div>
</template>
<script>
	export	default{
		data(){
			return{
				aulas:[],
				cursos:[],
				newItem:{'dia':'','hora_inicio':'','hora_fin':'','aula_id':'','curso_id':''},
				formErrors:{},
				formErrorsUpdate:{},
			}
		},
		created(){
			this.getAula();
			this.getCurso();
			
		},
		methods:{
			getAula: function(){
				var that =this;
				axios.get('/aulas/combo').then(function(response){
					that.aulas=response.data;
				});
			},
			getCurso: function(){
				var that=this;
				axios.get('/cursos/combo').then(function(response){
					that.cursos=response.data;
				});
			},
			createItem: function(){
				var input = this.newItem;
				if((input['dia']=='') || (input['hora_inicio']=='') || (input['hora_fin']=='') || (input['aula_id']=='') || (input['curso_id']=='')){
					toastr.warning('Complete los campos', {timeOut: 5000});
				}
				else{
					axios.post('/horarios',input).then(response =>{
						this.newItem={'dia':'','hora_inicio':'','hora_fin':'','aula_id':'','curso_id':''};
						toastr.success('Nuevo Horario Registrado con éxito',{timeOut: 5000})
					});
				}
			},
			clean: function(){
				this.newItem={'dia':'','hora_inicio':'','hora_fin':'','aula_id':'','curso_id':''};
			}
		}
	}
</script>