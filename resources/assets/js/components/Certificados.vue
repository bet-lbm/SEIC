<template>
	<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-title">
	   			<div class="row line-head">
	   				<h5 class="col-md-6 col-sm-6 col-xs-6"><i class="fa fa-calendar"></i><b>FECHA :</b>&nbsp;&nbsp; {{ today }}</h5>
	   			</div>
   			</div>
            <div class="card-body">
                <div class="row invoce-info line-head">
   					<div class="col-md-3">
				        <h3 class="text-center ">
	                        <i class="fa fa-certificate"></i><br>SEIC<br><small>CERTIFICADO</small>
	                    </h3>
					</div>
					<div class="col-sm-9 col-md-9 col-xs-6">
						<div class="col-md-5">
							<br><i class="fa fa-id-card-o"></i><b>DNI :</b>
							<input class="form-control" type="text" placeholder="DNI" autofocus="autofocus" v-model="dni" v-on:keyup="getNotas(dni)">
						</div>
						<div class="col-md-7">
							<br><i class="fa fa-book"></i><b>Curso :</b>
							<select class="form-control" required="required" name="nota_id" autofocus="autofocus" v-model="newItem.nota_id">
								<option v-for="item2 in items2" :value="item2.id">{{ item2.nombre }}:: {{ item2.code }}::{{ item2.nombres }} {{ item2.apellidos }}:: {{ item2.nota }} </option>
							</select>
						</div>
					</div>
					<div class="row">
	                    <div class="col-md-7 col-md-offset-4">
	                        <button class="btn btn-primary icon-btn" type="button" @click.prevent="createItem()" ><i class="fa fa-fw fa-lg fa-check-circle"></i>Registrar</button>&nbsp;&nbsp;&nbsp;<button class="btn btn-default icon-btn" type="button" @click.prevent="clean()"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</button>
	                    </div>
	                </div>
   				</div>

                <p class="line-head"></p>
                <table class="table table-hover">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Codigo Matricula</th>
                        <th>Nombre y Apellido</th> 
                        <th style="width: 20%">Curso</th>
						<th style="width: 10%">Nota</th>
						<th>dia</th>
						<th style="width: 10%">fecha</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="item in items">
                        <td>{{ item.id }}</td>
                        <td>{{ item.code }}</td>
                        <td>{{ item.nombres }} {{ item.apellidos }}</td>
                        <td>{{ item.nombre }}</td>
                        <td>{{ item.nota }}</td>
                        <td>{{ item.dia }}</td>
                        <td>{{ item.fecha }}</td>
                      </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
  </div>
</template>
<script>
	export default{
		data(){
			return{
				date:new Date(),
				dni:'',
				items:[],
				items2:[],
				formErrors:{},
				formErrorsUpdate:{},
				newItem:{'nota_id':'','fecha':''},
			} 
		},
		computed:{
			today: function()
	        {
	            return this.date.toLocaleString("es-CL", {year: "numeric", month: "numeric",day: "numeric"});
	        },
		},
		mounted(){
			this.getVueItems();
		},
		created(){
			this.dateFormat();
		},
		methods:{
			getVueItems: function(){
				var that=this;
				axios.get('/certificados').then(response=>{
					that.items=response.data;
				});
			},
			getNotas:function(dni){
				var that=this;
				axios.get('/certificados/combo/'+dni).then(response=>{
					that.items2=response.data;
				});
			},
			dateFormat: function() {
	            let date = new Date(this.date);
	            this.newItem.fecha = date.getFullYear() + '-' + ('0' + (date.getMonth()+1)).slice(-2) + '-'+ ('0' + date.getDate()).slice(-2);
	        },
	        createItem:function(){
	        	var input=this.newItem;
	        	if((input['nota_id']=='')){
	        		toastr.warning('complete los campos',{timeOut:5000});
	        	}
	        	else{
	        		axios.post('/certificados',input).then(response=>{
	        			//this.newItem={'nota_id':''};
	        			toastr.success('Certificado Registrado',{timeOut:5000});
	        			this.getVueItems();
	        		});
	        	}
	        },
	        clean:function(){
				this.newItem={'nota_id':''};
			},
		}
	}
</script>