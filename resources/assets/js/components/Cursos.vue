<template>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
    		<div class="card">
                <h5 class="card-title"> </h5>
                <div class="card-body">
        			<table class="table table-hover" role="grid"> 
        				<thead>
        					<tr>
        						<th style="width: 2%">#</th>
        						<th style="width: 50%">Nombre</th>
        						<th>Duración</th>
        						<th>Máximo alumnos</th>
        						<th colspan="3">&nbsp;</th>
        					</tr>
        				</thead>
        				<tbody>
        					<tr v-for="(item, index) in items">
        						<th>{{ index + 1 + (pagination.current_page - 1) * 10 }}</th>
        						<td>{{ item.nombre }}</td>
        						<td>{{ item.duracion }}  horas</td>
        						<td class="text-center">{{ item.max_alumnos }}</td>
        						<td width="10px">
        							<button class="btn-link"  @click.prevent="showItem(item)" title="Show"> 
                                        <i class="fa fa-eye"></i>
        							</button>
        						</td>
        						<td width="10px">
                                    <button class="btn-link" @click.prevent="editItem(item)" title="Edit">    
                                    <i class="fa fa-pencil-square-o"></i>
                                    </button>
                                </td>
        						<td width="10px">
                                    <button class="btn-link" @click.prevent="deleteItem(item)" title="Delete">
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
                        <h5 class="modal-title" id="myModalLabel"> Detalles de curso </h5> 
                    </div>
                    <div class="modal-body">
                        <div class="card">
                            <h5 class="card-title"><i class="fa fa-laptop"></i><b> {{ fillItem.nombre }} </b></h5>    
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <p class="col-md-6 col-sm-6 col-xs-6"> <i class="fa fa-clock-o"></i> Duración:</p>
                                        <p class="col-md-6 col-sm-6 col-xs-6">{{ fillItem.duracion }} </p>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <p class="col-md-9 col-sm-9 col-xs-9"><i class="fa fa-users"></i> Máx. Alumnos:</p>
                                        <p class="col-md-3 col-sm-3 col-xs-3"> {{ fillItem.max_alumnos }} </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="edit-item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel"> <small>Editar Curso</small> </h4> 
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal form-label-left" method="POST" enctype="multipart/form-data" v-on:submit.prevent="updateItem(fillItem.id)">
                            <div class="form-group">
                                <label class="control-label col-md-3">Nombre : </label>
                                <div class="col-md-8 col-xs-12">
                                    <input class="form-control" type="text" name="nombre" v-model="fillItem.nombre" />
                                </div>
                                <span v-if="formErrorsUpdate['nombre']" class="error text-danger">{{ formErrorsUpdate['nombre'] }}</span>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Duración (horas) : </label>
                                <div class="col-md-8 col-xs-12">    
                                    <input class="form-control" type="number" name="duracion" v-model="fillItem.duracion" autofocus/>
                                </div>
                                <span v-if="formErrorsUpdate['duracion']" class="error text-danger">{{ formErrorsUpdate['duracion'] }}</span> 
                            </div>             
                            <div class="form-group">
                                <label class="control-label col-md-3">Máx. Alumnos : </label>
                                <div class="col-md-8 col-xs-12">    
                                    <input class="form-control" type="number" name="maximo" v-model="fillItem.max_alumnos" />
                                </div>
                                <span v-if="formErrorsUpdate['maximo']" class="error text-danger">{{ formErrorsUpdate['maximo'] }}</span>
                            </div> 
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary"> Guadar cambios </button>
                                <button data-dismiss="modal"  class="btn btn-default" type="button">Cancelar</button>
                            </div> 
                        </form> 
                    </div>
                </div>
            </div>
        </div>

    </div>


</template>
<script>
export default {
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
            fillItem : {'id': '','nombre':'','duracion':'','max_alumnos':''},
        }
    },
	computed: {
        isActived: function() {
            return this.pagination.current_page;
        },

        pagesNumber: function() {
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
    methods : {

        getVueItems: function(page){
        	var that = this;
            axios.get('/cursos?page='+page).then(function (response) {
                that.items = response.data.data.data;
                that.pagination = response.data.pagination;
                that.$nextTick(function() {
                    $('[data-toggle="popover"]').popover();
                })
            });
        },
        changePage: function(page) {
            this.pagination.current_page = page;
            this.getVueItems(page);
        },
        showItem: function(item){
            var that = this;
            axios.get('/cursos/'+item.id).then(function(response){
                that.fillItem.nombre = response.data.nombre;
                that.fillItem.duracion = response.data.duracion;
                that.fillItem.max_alumnos = response.data.max_alumnos;
            })
            $("#show-item").modal('show');
        },

        editItem: function(item){
            var that = this;
            this.fillItem.id= item.id;
            axios.get('/cursos/'+item.id).then(function(response){
                that.fillItem.nombre = response.data.nombre;
                that.fillItem.duracion = response.data.duracion;
                that.fillItem.max_alumnos = response.data.max_alumnos;
            })
            $("#edit-item").modal('show');
        },

        updateItem: function(id){
            var input = this.fillItem;
            axios.put('/cursos/'+id,input).then((response) => {
                this.changePage(this.pagination.current_page);
                this.fillItem =  {'id': '','nombre':'','duracion':'','max_alumnos':''};
                $("#edit-item").modal('hide');
                toastr.success('Curso correctamente editado.', {timeOut: 5000});
            }, 
            (response) => {
                that.formErrorsUpdate = response.data;
            });
        },

        deleteItem: function(item){
            axios.delete('/cursos/'+item.id).then((response) => {
                this.changePage(this.pagination.current_page);
                toastr.error('Curso eliminado', {timeOut: 5000});
            });
        }
    }
}
</script>