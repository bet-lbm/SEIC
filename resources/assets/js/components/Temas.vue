<template>
	<div class="row">		
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="card">
				<div class="card-body">
					<div class="col-md-4 pull-right top_search">
                        <div class="input-group">
                            <input class="form-control" type="text" v-model="queryString" v-on:keyup="getResults()" placeholder="Buscar">
                            <span class="input-group-addon"><i class="fa fa-search"></i></span>
                        </div>
                    </div>
                    <div></div>
					<table class="table table-hover">
						<thead>
							<tr>
								<th>#</th>
								<th>Tema</th>
								<th>Fecha</th>
								<th>descripcion</th>
								<th>horario</th>
							</tr>
						</thead>
						<tbody>
							<tr v-for="(item,index) in items">
								<th>{{ index+1+(pagination.current_page-1)*10 }}</th>
								<td>{{ item.tema }}</td>
								<td>{{ item.fecha }}</td>
								<td>{{ item.descripcion }}</td>
								<td>{{ item.horario_id }}</td>
								<td width="10px">
									<button class="btn-link" title="show" @click.prevent="showItem(item)">
										<i class="fa fa-eye"></i>
									</button>
								</td>
								<td width="10px">
									<button class="btn-link" title="Edit">
										<i class="fa fa-pencil-square-o"></i>
									</button>
								</td>
								<td width="10px">
									<button class="btn-link" title="Delete" @click.prevent="deleteItem(item)">
										<i class="fa fa-trash-o"></i>
									</button>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
				<div class="card-footer">
		            <div  v-if="pagination.last_page > 1"  v-cloak>
		                <ul class="pagination">
		                    <li v-if="pagination.current_page > 1">
		                        <a href="#" aria-label="Previous" @click="changePage(pagination.current_page - 1)">
		                            <span aria-hidden="true">&laquo;</span>
		                        </a>
		                    </li>
		                    <li v-for="page in pagesNumber" v-bind:class="[ page == isActived ? 'active' : '' ]">
		                        <a href="#" @click="changePage(page)">
		                            {{ page }}
		                        </a>
		                    </li>
		                    <li v-if="pagination.current_page < pagination.last_page">
		                        <a href="#" aria-label="Next" @click="changePage(pagination.current_page + 1)">
		                            <span aria-hidden="true">&raquo;</span>
		                        </a>
		                    </li>
		                </ul>
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
                    <h5 class="modal-title" id="myModalLabel"> Detalles del tema </h5> 
                </div>
                <div class="modal-body">
                    <div class="card">
                        <h5 class="card-title"><i class="fa fa-laptop"></i><b> {{ fillItem.tema }} </b></h5>    
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <p class="col-md-6 col-sm-6 col-xs-6"> <i class="fa fa-clock-o"></i> fecha:</p>
                                    <p class="col-md-6 col-sm-6 col-xs-6">{{ fillItem.fecha }} </p>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <p class="col-md-9 col-sm-9 col-xs-9"><i class="fa fa-users"></i> descripcion:</p>
                                    <p class="col-md-3 col-sm-3 col-xs-3"> {{ fillItem.descripcion }} </p>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <p class="col-md-9 col-sm-9 col-xs-9"><i class="fa fa-users"></i> dia:</p>
                                    <p class="col-md-3 col-sm-3 col-xs-3"> {{ fillItem.dia }} </p>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <p class="col-md-9 col-sm-9 col-xs-9"><i class="fa fa-users"></i> Hora:</p>
                                    <p class="col-md-3 col-sm-3 col-xs-3"> {{ fillItem.hora_inicio }} </p>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <p class="col-md-9 col-sm-9 col-xs-9"><i class="fa fa-users"></i> Nombre:</p>
                                    <p class="col-md-3 col-sm-3 col-xs-3"> {{ fillItem.nombre }} </p>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <p class="col-md-9 col-sm-9 col-xs-9"><i class="fa fa-users"></i> aula:</p>
                                    <p class="col-md-3 col-sm-3 col-xs-3"> {{ fillItem.numero_aula }} </p>
                                </div>
                            </div>
                        </div>
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
					items: [],
		            pagination: {
		                total: 0,
		                per_page: 2,
		                from: 1,
		                to: 0,
		                current_page: 1,
		            },

		            formErrors: {},
		            formErrorsUpdate: {},
		            offset: 4,
		            fillItem : {'id': '','tema':'','fecha':'','descripcion':'','dia':'','hora_inicio':'','nombre':'','numero_aula':''},
		            queryString:'',
				}
			},
			computed:{
				isActivated: function(){
					return this.pagination.current_page;
				},
				pagesNumber:function(){
					if (!this.pagination.to) {
	                return [];
		            }
		            var from = this.pagination.current_page - this.offset;
		            if (from < 1) {
		                from = 1;
		            }
		            var to = from + (this.offset * 2);
		            if (to >= this.pagination.last_page) {
		                to = this.pagination.last_page;
		            }
		            var pagesArray = [];
		            while (from <= to) {
		                pagesArray.push(from);
		                from++;
		            }
		            return pagesArray;
				}

			},
			mounted() {
				this.getVueItems(this.pagination.current_page);
			},
			methods:{
				getVueItems:function(page){
					var that =this;
					axios.get('/temas?page'+page).then(function(response){
						that.items=response.data.data.data;
						that.pagination=response.data.pagination;
						that.$nextTick(function(){
							$('[data-toggle="popover"]').popover();
						})
					});
				},
				getResults(){
		            var that=this;
		            axios.get('/temas/search',{params:{queryString:this.queryString}}).then(response=>{
		                that.items=response.data.data.data;
		                that.pagination=response.data.pagination;
		            })
		        },
				changePage:function(page){
					this.pagination.current_page=page;
					this.getVueItems(page);
				},
				deleteItem:function(item){
					axios.delete('/temas/'+item.id).then((response)=>{
						this.changePage(this.pagination.current_page);
						toastr.error('tema eliminado',{timeOut:5000});
					});
				},

				showItem: function(item){
					var that = this;
					axios.get('/temas/get/'+item.id).then(function(response){
						that.fillItem.tema = response.data.tema;
						that.fillItem.fecha = response.data.fecha;
						that.fillItem.descripcion = response.data.descripcion;
						that.fillItem.dia = response.data.dia;
						that.fillItem.hora_inicio = response.data.hora_inicio;
						that.fillItem.nombre = response.data.nombre;
						that.fillItem.numero_aula = response.data.aula_numero;
					});
					$("#show-item").modal('show');
					console.log('estoy aca');
				}
			}
	}
</script>