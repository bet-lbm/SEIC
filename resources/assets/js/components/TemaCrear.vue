<template>
	<div class="row">
		<div class="col-md-10 col-sm-12 col-xs-12 col-md-offset-1">
			<div class="card">
				<h4 class="card-title line-head"><i class="fa fa-laptop">REGISTRAR TEMA</i></h4>
				<form class="form-horizontal" method="POST" v-on:submit.prevent="createItem()">
					<div class="card-body">
						<div class="form-group">
							<label class="control-label col-md-3">TEMA</label>
							<div class="col-md-8">
								<input type="text" class="form-control" placeholder="Tema"  name="tema" required="required" autofocus="autofocus" v-model="newItem.tema">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-3">FECHA</label>
							<div class="col-md-8">
								<datepicker  calendar-button calendar-button-icon="fa fa-calendar"  name="fecha" language="es" :format="customFormatter" placeholder="Seleccionar fecha" v-model="date"></datepicker>
								<output type="hidden" style="visibility:hidden">{{ dateFormat }}</output>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-3">DESCRIPCION</label>
							<div class="col-md-8">
								<input type="text" class="form-control" name="descripcion" placeholder="Descripcion del tema avanzar" required="required" autofocus="autofocus" v-model="newItem.descripcion">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-3">HORARIO</label>
							<div class="col-md-8">
								<select class="form-control" required="required" name="horario_id" v-model="newItem.horario_id" autofocus="autofocus">
									<option v-for="horario in horarios" :value="horario.id">{{horario.nombre}}-{{ horario.dia }}-{{ horario.hora_inicio}} a {{horario.hora_fin}}-aula:{{ horario.numero_aula }}</option>
								</select>
							</div>
						</div>
						<div class="card-footer">
							<div class="row">
								<div class="col-md-8 col-md-offset-4">
									<button class="btn btn-primary icon-btn" type="submit" >
										<i class="fa fa-fw fa-lg fa-check-circle">
										</i>Registrar
									</button>&nbsp;&nbsp;&nbsp;
									<button class="btn btn-defaut icon-btn" type="button" >
										<i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar
									</button>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</template>
<script>
import Datepicker from 'vuejs-datepicker';
import moment from 'moment';

	export default{
		data(){
			return{
				
				horarios:[],
				newItem:{'tema':'','fecha':'','descripcion':'','horario_id':''},
				formErrors:{},
				formErrorsUpdate:{},
				date:'',
			}
		},
		
		components:{
	        Datepicker
	    },
	    computed:{
	    	dateFormat: function() {
		    	let date = new Date(this.date);
		      	return this.newItem.fecha = date.getFullYear() + '-'
                                        + ('0' + (date.getMonth()+1)).slice(-2) + '-'
                                        + ('0' + date.getDate()).slice(-2);
		    },
	    },
	    created(){
			this.getHorario();
		},
		methods:{
			customFormatter(date){
	            return moment(date).format('DD-MM-YYYY');
	        },

			getHorario: function(){
				var that=this;
				axios.get('/temas/combo').then(function(response){
					that.horarios=response.data;
				});
			},
			createItem:function(){
				var input=this.newItem;
				if((input['tema']=='')||(input['descripcion']=='')||(input['horario_id']=='')){
					toastr.warning('complete los campos',{timeOut:5000});
				}
				else{
					axios.post('/temas',input).then(response=>{
						this.newItem={'tema':'','fecha':'','descripcion':'','horario_id':''};
						toastr.success('Nuevo Tema Registrado con exito',{timeOut:5000})
					});
				}
			},
			clean:function(){
				this.newItem={'tema':'','fecha':'','descripcion':'','horario_id':''};
			}
		}

	}
</script>