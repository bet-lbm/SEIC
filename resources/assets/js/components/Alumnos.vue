<template>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
    		<div class="card">
                <h5 class="card-title"> </h5>
                <div class="card-body">
                    <div class="col-md-4 pull-right top_search">
                        <div class="input-group">
                            <input class="form-control" type="text" v-model="queryString" v-on:keyup="getResults()" placeholder="Buscar">
                            <span class="input-group-addon"><i class="fa fa-search"></i></span>
                        </div>
                    </div>
                    <div></div>
        			<table class="table table-hover" role="grid"> 
        				<thead>
        					<tr>
        						<th style="width: 2%">#</th>
        						<th class="text-center">DNI</th>
                                <th style="width: 30%">Apellidos y Nombres</th>
        						<th>e-mail</th>
        						<th>Telefono</th>
        						<th colspan="3">&nbsp;</th>
        					</tr>
        				</thead>
        				<tbody>
        					<tr v-for="(item, index) in items">
        						<th>{{ index + 1 + (pagination.current_page - 1) * 10 }}</th>
        						<td class="text-center">{{ item.dni }}</td>
                                <td>{{ item.apellidos }} {{ item.nombres }}</td>
        						<td>{{ item.email }}</td>
        						<td>{{ item.telefono }}</td>
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
                        <h5 class="modal-title" id="myModalLabel"> Detalles de alumno </h5> 
                    </div>
                    <div class="modal-body">
                        <h4 class="text-center" v-if="fillItem.sexo === 'M'"><i class="fa fa-male"></i><b> {{ fillItem.apellidos }} {{ fillItem.nombres }} </b></h4>
                        <h4 class="text-center" v-if="fillItem.sexo === 'F'"><i class="fa fa-female"></i><b> {{ fillItem.apellidos }} {{ fillItem.nombres }} </b></h4>                       
                        <div class="row">
                            <p class="col-md-4 col-sm-4 col-xs-4 text-right"><i class="fa fa-id-card-o"></i> DNI :</p>
                            <p class="col-md-8 col-sm-8 col-xs-8">{{ fillItem.dni }}</p>
                        </div>
                        <div class="row">
                            <p class="col-md-4 col-sm-4 col-xs-4 text-right"><i class="fa fa-home"></i> Dirección :</p>
                            <p class="col-md-8 col-sm-8 col-xs-8">{{ fillItem.direccion }}</p>
                        </div>
                        <div class="row">
                            <p class="col-md-4 col-sm-4 col-xs-4 text-right"><i class="fa fa-phone"></i> Telefono :</p>
                            <p class="col-md-8 col-sm-8 col-xs-8"> {{ fillItem.telefono }} </p>
                        </div>
                        <div class="row">
                            <p class="col-md-4 col-sm-4 col-xs-4 text-right"><i class="fa fa-envelope-o"></i> e-mail :</p>
                            <p class="col-md-8 col-sm-8 col-xs-8">{{ fillItem.email }}</p>
                        </div>
                        <div class="clearfix"></div>
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="modal" id="edit-item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                        </button>
                        <h5 class="modal-title" id="myModalLabel"> Editar datos de alumno </h5> 
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal form-label-left" method="POST" enctype="multipart/form-data" v-on:submit.prevent="updateItem(fillItem.id)">
                            <div class="form-group">
                                <label class="control-label col-md-3">DNI : </label>
                                <div class="col-md-8 col-xs-12">
                                    <input class="form-control" type="text" name="dni" v-model="fillItem.dni" />
                                </div>
                                <span v-if="formErrorsUpdate['dni']" class="error text-danger">{{ formErrorsUpdate['dni'] }}</span>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Nombres : </label>
                                <div class="col-md-8 col-xs-12">
                                    <input class="form-control" type="text" name="nombres" v-model="fillItem.nombres" autofocus/>
                                </div>
                                <span v-if="formErrorsUpdate['nombres']" class="error text-danger">{{ formErrorsUpdate['nombres'] }}</span>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Apellidos : </label>
                                <div class="col-md-8 col-xs-12">
                                    <input class="form-control" type="text" name="apellidos" v-model="fillItem.apellidos"/>
                                </div>
                                <span v-if="formErrorsUpdate['apellidos']" class="error text-danger">{{ formErrorsUpdate['apellidos'] }}</span>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Dirección : </label>
                                <div class="col-md-8 col-xs-12">    
                                    <input class="form-control" type="address" name="direccion" v-model="fillItem.direccion" />
                                </div>
                                <span v-if="formErrorsUpdate['direccion']" class="error text-danger">{{ formErrorsUpdate['direccion'] }}</span>
                            </div> 
                            <div class="form-group">
                                <label class="control-label col-md-3">Teléfono : </label>
                                <div class="col-md-8 col-xs-12">    
                                    <input class="form-control" type="phone" name="telefono" v-model="fillItem.telefono" />
                                </div>
                                <span v-if="formErrorsUpdate['telefono']" class="error text-danger">{{ formErrorsUpdate['telefono'] }}</span>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">e-mail : </label>
                                <div class="col-md-8 col-xs-12">    
                                    <input class="form-control" type="email" name="email" v-model="fillItem.email" />
                                </div>
                                <span v-if="formErrorsUpdate['email']" class="error text-danger">{{ formErrorsUpdate['email'] }}</span> 
                            </div> 
                            <div class="form-group">
                                <label class="control-label col-md-3">Género</label>

                                <div class="animated-radio-button col-md-4">
                                    <label>  
                                        <input class="form-control" type="radio" value="F" v-model="fillItem.sexo">
                                            <span class="label-text">Femenino</span>
                                        </input>
                                    </label>
                                </div>
                                <div class="animated-radio-button col-md-4">
                                    <label>
                                        <input class="form-control" type="radio" value="M" v-model="fillItem.sexo">
                                            <span class="label-text">Masculino</span>
                                        </input>
                                    </label>
                                </div>
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
            fillItem : {'id': '','dni':'','nombres':'','apellidos':'','sexo':'','direccion':'','email':'','telefono':''},
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
            axios.get('/alumnos?page='+page).then(function (response) {
                that.items = response.data.data.data;
                that.pagination = response.data.pagination;
                that.$nextTick(function() {
                    $('[data-toggle="popover"]').popover();
                })
            });
        },
        getResults(){
            var that=this;
            axios.get('/alumnos/search',{params:{queryString:this.queryString}}).then(response=>{
                that.items=response.data.data.data;
                that.pagination=response.data.pagination;
            })
        },
        changePage: function(page) {
            this.pagination.current_page = page;
            this.getVueItems(page);
        },
        showItem: function(item){
            var that = this;
            axios.get('/alumnos/'+item.id).then(function(response){
                that.fillItem.dni = response.data.dni;
                that.fillItem.nombres = response.data.nombres;
                that.fillItem.apellidos = response.data.apellidos;
                that.fillItem.sexo = response.data.sexo;
                that.fillItem.direccion = response.data.direccion;
                that.fillItem.telefono = response.data.telefono;
                that.fillItem.email = response.data.email;
            })
            $("#show-item").modal('show');
        },

        editItem: function(item){
            var that = this;
            this.fillItem.id= item.id;
            axios.get('/alumnos/'+item.id).then(function(response){
                that.fillItem.dni = response.data.dni;
                that.fillItem.sexo = response.data.sexo;
                that.fillItem.nombres = response.data.nombres;
                that.fillItem.apellidos = response.data.apellidos;
                that.fillItem.direccion = response.data.direccion;
                that.fillItem.telefono = response.data.telefono;
                that.fillItem.email = response.data.email;
            })
            $("#edit-item").modal('show');
        },

        updateItem: function(id){
            var input = this.fillItem;
            axios.put('/alumnos/'+id,input).then((response) => {
                this.changePage(this.pagination.current_page);
                this.fillItem={'id': '','dni':'','nombres':'','apellidos':'','sexo':'','direccion':'','email':'','telefono':''};
                $("#edit-item").modal('hide');
                toastr.success('Datos de alumno correctamente editado.', {timeOut: 5000});
            }, 
            (response) => {
                that.formErrorsUpdate = response.data;
            });
        },

        deleteItem: function(item){
            axios.delete('/alumnos/'+item.id).then((response) => {
                this.changePage(this.pagination.current_page);
                toastr.error('Alumno eliminado', {timeOut: 5000});
            });
        }
    }
}
</script>