<template>
	<div class="row">
    <div class="col-md-12">
        <div class="card">
            <h4 class="card-title line-head"><i class="fa fa-plus"></i>   Agregar aula nueva </h4>
            <div class="card-body">
                <form action="" class="form-horizontal">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="" class="control-label col-md-6">N° de Aula :</label>
                                <div class="col-md-6">
                                    <input class="form-control" type="text" required="required" v-model="newItem.numero_aula">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="form-group">
                                <label for="" class="control-label col-md-4">Descripción/Observación:</label>
                                <div class="col-md-8">
                                    <input class="form-control" type="text" required="required" v-model="newItem.descripcion">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-primary" type="button"  @click.prevent="createItem()" ><i class="fa fa-fw fa-lg fa-check"></i></button>&nbsp;&nbsp;&nbsp;<button class="btn btn-default" type="button" @click.prevent="clean()"><i class="fa fa-fw fa-lg fa-times"></i></button>
                        </div>
                    </div>
                </form>
                <p class="line-head"></p>
                <table class="table table-hover">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th style="width: 10%" >Aula</th> 
                        <th>Descripción/Observación</th>
                        <th colspan="2">&nbsp;</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="(item, index) in items">
                        <td>{{ index + 1 + (pagination.current_page - 1) * 10 }}</td>
                        <td>{{ item.numero_aula }}</td>
                        <td>{{ item.descripcion }}</td>
                        <td width="10px">
                            <button class="btn-link"  @click.prevent="editItem(item)" title="Edit"> 
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
                <nav class="pull-right" v-if="pagination.last_page > 1"  v-cloak>
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
                </nav>
            </div>
        </div>
    </div>
    <div class="modal" id="edit-item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                    </button>
                    <h5 class="modal-title" id="myModalLabel"> Modificar detalles de aula </h5> 
                </div>
                <div class="modal-body">
                    <form class="form-horizontal">
                        <div class="form-group">
                            <p class="col-md-3 col-sm-3 col-xs-3 text-right">N° de Aula :</p>
                            <div class="col-md-8 col-sm-8 col-xs-8"> 
                                <input type="text" class="form-control" v-model="fillItem.numero_aula" autofocus>
                            </div>
                        </div>
                        <div class="form-group">
                            <p class="col-md-3 col-sm-3 col-xs-3 text-right">Descripción :</p>
                            <div class="col-md-8 col-sm-8 col-xs-8"> 
                                <input type="text" class="form-control" v-model="fillItem.descripcion">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button @click.prevent="updateItem(fillItem.id)" class="btn btn-primary"> Guadar cambios </button>
                    <button data-dismiss="modal"  class="btn btn-default" type="button">Cancelar</button>
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
        offset: 4,
        formErrors: {},
        formErrorsUpdate: {},
        newItem : {'numero_aula':'','descripcion':''},
        fillItem :{'id':'','numero_aula':'','descripcion':''}
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
    mounted(){
      this.getVueItems(this.pagination.current_page);
    },
    methods : {

        createItem: function(){
            var input = this.newItem;
            if((input['numero_aula'] == '')||(input['descripcion'] == '')){
                toastr.warning('Complete todos los campos', {timeOut: 5000});
            }
            else{
                axios.post('/aulas',input)
                .then(response => {
                    this.newItem = {'numero_aula':'','descripcion':''};
                    toastr.success('Aula registrada', {timeOut: 5000});
                    this.getVueItems();
                });
            }
        },

        clean: function(){
            this.newItem = {'numero_aula':'','descripcion':''};
        },

        getVueItems: function(page){
          var that = this;
            axios.get('/aulas?page='+page).then(function (response) {
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
        
        editItem: function(item){
            var that = this;
            this.fillItem.id = item.id;
            axios.get('/aulas/'+item.id).then(function(response){
                that.fillItem.numero_aula = response.data.numero_aula;
                that.fillItem.descripcion = response.data.descripcion;
            })
            $("#edit-item").modal('show');
        },
        
        updateItem: function(id){
            var input = this.fillItem;
            var that = this;
            axios.put('/aulas/'+id,input).then(function(response){
                that.changePage(that.pagination.current_page);
                that.fillItem={'id':'','numero_aula':'','descripcion':''};
                $("#edit-item").modal('hide');
                toastr.success('Datos modificados.', {timeOut: 5000});
            })
        },
        
        deleteItem: function(item){
            axios.delete('/aulas/'+item.id).then((response) => {
                this.changePage(this.pagination.current_page);
                toastr.error('Aula eliminada', {timeOut: 5000});
            });
        }
    }
  }

</script>