<template>
   <div class="row">
   		<div class="card">
   			<div class="card-title">
	   			<div class="row line-head">
	   				<h5 class="col-md-6 col-sm-6 col-xs-6"><i class="fa fa-calendar"></i><b>FECHA :</b>&nbsp;&nbsp;{{ today }}</h5>
	   			</div>
   			</div>
   			<div class="card-body">
   				<div class="row invoce-info line-head">
   					<div class="col-md-3">
				        <h3 class="text-center ">
	                        <i class="fa fa-graduation-cap"></i><br>SEIC<br><small>NOTAS</small>
	                    </h3>
					</div>
					<div class="col-sm-9 col-md-9 col-xs-6">
						<div class="col-md-5">
							<br><i class="fa fa-id-card-o"></i><b>DNI :</b>
							<input class="form-control" type="text" placeholder="DNI" autofocus="autofocus" v-model="dni" v-on:keyup="getResults(dni)">
							<br><i class="fa fa-pencil"></i><b>NOTA :</b>
							<input class="form-control col-md-8" min="5" type="number" placeholder="20" required="required" v-model="newItem.nota">
						</div>
						<div class="col-md-7">
							<br><i class="fa fa-book"></i><b>Curso :</b>
							<select class="form-control" required="required" name="matricula_id" v-model="newItem.matricula_id" autofocus="autofocus">
								<option v-for="item in items" :value="item.code">{{ item.nombre }} :: {{ item.nombres }}-{{item.apellidos }}</option>
							</select>
							<br><i class="fa fa-calendar"></i><b>Descripcion:</b>
							<input class="form-control" type="text" placeholder="descripcion" v-model="newItem.descripcion">
						</div>
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
   		</div>
   </div>
</template>
<script>
	export default{
		data(){
			return{
				date: new Date(),
				dni:'',
				items:[],
				pagination: {
		            total: 0,
		            per_page: 2,
		            from: 1,
		            to: 0,
		            current_page: 1,
		        },
		        offset: 4,
		        formErrors:{},
		        formErrorsUpdate:{},
		        newItem:{'nota':'','descripcion':'','fecha':'','matricula_id':''}
			}
		},
		computed:{
			today: function(){
				return this.date.toLocaleString("es-CL", {year: "numeric",month: "numeric",day: "numeric"});
			}
		},
		created(){
			this.dateFormat();
		},
		methods:{
			getResults(dni){
				var	 that =this;
				axios.get('/notas/combo/'+dni).then(response=>{
					that.items=response.data;
				})
			},
			createItem: function(){
				var input=this.newItem;
				if((input['matricula_id']=='')||(input['notas']=='')){
					toastr.warning('comple los campos',{timeOut:5000});
				}
				else{
					axios.post('/notas',input).then(response=>{
						console.log('estoy aca');
						this.newItem={'nota':'','descripcion':'','fecha':'','matricula_id':''};
						toastr.success('Nota Registrada con exito',{timeOut:5000});
					});
				}
			},
			clean:function(){
				this.newItem={'nota':'','descripcion':'','fecha':'','matricula_id':''};
			},
			dateFormat: function() {
	            let date = new Date(this.date);
	            this.newItem.fecha = date.getFullYear() + '-' + ('0' + (date.getMonth()+1)).slice(-2) + '-'+ ('0' + date.getDate()).slice(-2);
	        },

		}
	}
</script>