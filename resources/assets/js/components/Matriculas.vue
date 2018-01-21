<template>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
    		<div class="card">
                <h5 class="card-title"> </h5>
                <div class="card-body">
        			<table class="table table-hover"> 
        				<thead>
        					<tr>
                                <th class="text-center">Código</th>
        						<th class="text-center">DNI</th>
                                <th>Apellidos y Nombres</th>
        						<th>Estado</th>
        						<th style="width: 50%">Curso</th>
        						<th colspan="1">&nbsp;</th>
        					</tr>
        				</thead>
        				<tbody>
        					<tr v-for="item in items">
                                <th>{{ item.code }}</th>
                                <td class="text-center">{{ item.dni }}</td>
                                <td>{{ item.apellidos }} {{ item.nombres }}</td>
        						<td>
                                    <p v-if="item.estado === 0" class="text-danger"><small><b>DEUDA</b></small></p>
                                    <p v-if="item.estado === 1" class="text-success"><small><b>CANCELADO</b></small></p>
                                </td>
        						<td>{{ item.nombre }}</td>
        						<td width="10px">
        							<button class="btn-link"  @click.prevent="showItem(item)" title="Show"> 
                                        <i class="fa fa-eye"></i>
        							</button>
        						</td>
        					</tr>
        				</tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <div v-if="pagination.last_page > 1"  v-cloak>
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
            fillItem : {'code': '','dni':'','nombres':'','apellidos':'','estado':'','curso':''},
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
            axios.get('/matriculas?page='+page).then(function (response) {
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
            axios.get('/alumnos/'+item.dni).then(function(response){
                that.fillItem.dni = response.data.dni;
                that.fillItem.nombres = response.data.nombres;
                that.fillItem.apellidos = response.data.apellidos;
                that.fillItem.sexo = response.data.sexo;
                that.fillItem.direccion = response.data.direccion;
                that.fillItem.telefono = response.data.telefono;
                that.fillItem.email = response.data.email;
            })
            $("#show-item").modal('show');
        }
    }
}
</script>