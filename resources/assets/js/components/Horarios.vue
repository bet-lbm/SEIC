<template>
	<div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
          <table class="table table-hover">
            <thead>
              <tr>
                <th>#</th>
                <th>dia</th> 
                <th>Hora Inicio</th>
                <th>Hora Fin</th>
                <th>aula</th>
                <th>curso</th>
                <th colspan="1">&nbsp;</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(item,index) in items">
                  <th>{{ index + 1 + (pagination.current_page - 1) * 10 }}</th>
                  <td>{{ item.dia }}</td>
                  <td>{{ item.hora_inicio }}</td>
                  <td>{{ item.hora_fin }}</td>
                  <td>{{ item.aula_id }}</td>
                  <td>{{ item.curso_id }}</td>
                  <td width="10px">
                      <button class="btn-link" title="Show">
                          <i class="fa fa-eye"></i>
                      </button>
                  </td>
                  <td width="10px">
                      <button class="btn-link" title="Edit" @click.prevent="editItem(item)">
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
    <div class="modal" id="edit-item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                    </button>
                    <h5 class="modal-title" id="myModalLabel"> Modificar detalles de Horario </h5> 
                </div>
                <div class="modal-body">
                    <form class="form-horizontal form-label-left" method="POST" enctype="multipart/form-data" v-on:submit.prevent="updateItem(fillItem.id)">
                        <div class="form-group">
                            <p class="col-md-3 col-sm-3 col-xs-3 text-right">DIA :</p>
                            <div class="col-md-8 col-sm-8 col-xs-8"> 
                                <input type="text" class="form-control" name="dia" v-model="fillItem.dia">
                            </div>
                            <span v-if="formErrorsUpdate['dia']" class="error text-danger">{{ formErrorsUpdate['dia'] }}</span>
                        </div>
                        <div class="form-group">
                            <p class="col-md-3 col-sm-3 col-xs-3 text-right">HORA INICIO :</p>
                            <div class="col-md-8 col-sm-8 col-xs-8"> 
                                <input type="text" class="form-control" name="hora_inicio" v-model="fillItem.hora_inicio">
                            </div>
                            <span v-if="formErrorsUpdate['hora_inicio']" class="error text-danger">{{ formErrorsUpdate['hora_inicio'] }}</span>
                        </div>
                         <div class="form-group">
                            <p class="col-md-3 col-sm-3 col-xs-3 text-right">HORA INICIO :</p>
                            <div class="col-md-8 col-sm-8 col-xs-8"> 
                                <input type="text" class="form-control" name="hora_fin" v-model="fillItem.hora_fin">
                            </div>
                            <span v-if="formErrorsUpdate['hora_fin']" class="error text-danger">{{ formErrorsUpdate['hora_fin'] }}</span>
                        </div>
                        <div class="form-group">
                            <p class="col-md-3 col-sm-3 col-xs-3 text-right">AULA :</p>
                            <div class="col-md-8 col-sm-8 col-xs-8"> 
                                <input type="text" class="form-control" name="aula_id" v-model="fillItem.aula_id">
                            </div>
                            <span v-if="formErrorsUpdate['aula_id']" class="error text-danger">{{ formErrorsUpdate['aula_id'] }}</span>
                        </div>
                        <div class="form-group">
                            <p class="col-md-3 col-sm-3 col-xs-3 text-right">CURSO :</p>
                            <div class="col-md-8 col-sm-8 col-xs-8"> 
                                <input type="text" class="form-control" name="curso_id" v-model="fillItem.curso_id">
                            </div>
                            <span v-if="formErrorsUpdate['curso_id']" class="error text-danger">{{ formErrorsUpdate['curso_id'] }}</span>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary"> Guadar cambios </button>
                    <button data-dismiss="modal"  class="btn btn-default" type="button">Cancelar</button>
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
            fillItem : {'id': '','dia':'','hora_inicio':'','hora_fin':'','aula_id':'','curso_id':''},
        }
    },
    computed:{
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
    methods:{
        getVueItems:function(page){
            var that=this;
            axios.get('/horarios?page'+page).then(function (response){
                that.items=response.data.data.data;
                that.pagination=response.data.pagination;
                that.$nextTick(function(){
                    $('[data-toggle="popover"]').popover();
                })
            });
        },
        changePage: function(page){
            this.pagination.current_page=page;
            this.getVueItems(page);
        },
        deleteItem: function(item){
          axios.delete('/horarios/'+item.id).then((response)=>{
            this.changePage(this.pagination.current_page);
            toastr.error('Horario eliminado', {timeOut: 5000});
          });
        },
        editItem: function(item){
          var that=this;
          this.fillItem.id=item.id;
          axios.get('/horarios/'+item.id).then(function(response){
            that.fillItem.dia=response.data.dia;
            that.fillItem.hora_inicio=response.data.hora_inicio;
            that.fillItem.hora_fin=response.data.hora_fin;
            that.fillItem.aula_id=response.data.aula_id;
            that.fillItem.curso_id=response.data.curso_id;
          })
          $("#edit-item").modal('show');
        },
        updateItem: function(id){
          var input = this.fillItem;
          axios.put('/horarios/'+id,input).then((response)=>{
            this.changePage(this.pagination.current_page);
            this.fillItem={'id': '','dia':'','hora_inicio':'','hora_fin':'','aula_id':'','curso_id':''};
            $("#edit-item").modal('hide');
            toastr.success('Datos de horario correctamente editado',{timeOut: 5000});
          },
          (response)=>{
            that.formErrorsUpdate=response.data;
          });
        }
    }
  }
</script>