<template> 
<div class="row">
    <div class="col-md-10 col-sm-12 col-xs-12 col-md-offset-1">
        <div class="card">
            <h4 class="card-title line-head"><i class="fa fa-laptop"></i> REGISTRAR NUEVO CURSO</h4>
            <form class="form-horizontal">
                <div class="card-body">
                    <div class="form-group">
                        <label class="control-label col-md-3">Nombre Curso</label>
                        <div class="col-md-8">
                            <input class="form-control" type="text" placeholder="Ingrese nombre completo" required="required" v-model="newItem.nombre">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Duración</label>
                        <div class="col-md-8">
                            <input class="form-control col-md-8" min="10" type="number" placeholder="10" required="required" v-model="newItem.duracion">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Max. Alumnos</label>
                        <div class="col-md-8">
                            <input class="form-control col-md-8" min="7" type="number" placeholder="7" required="required" v-model="newItem.max_alumnos">
                        </div>
                    </div>
               
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-md-8 col-md-offset-4">
                            <button class="btn btn-primary icon-btn" type="button"  @click.prevent="createItem()" ><i class="fa fa-fw fa-lg fa-check-circle"></i>Registrar</button>&nbsp;&nbsp;&nbsp;<button class="btn btn-default icon-btn" type="button" @click.prevent="clean()"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</button>
                        </div>
                    </div>
                </div>
            </form> 
             
        </div>
    </div>
</div> 
</template>
<script>
export default {
    data(){ 
        return{
            newItem : {'nombre':'','duracion':'','max_alumnos':''},
            formErrors: {},
            formErrorsUpdate: {},
        }
    },
    methods : {

        createItem: function(){
            var input = this.newItem;
            if((input['nombre'] == '')||(input['duracion'] == '')||(input['max_alumnos'] == '')){
                toastr.warning('Complete todos los campos', {timeOut: 5000});
            }
            else{
                axios.post('/cursos',input)
                .then(response => {
                    this.newItem = {'nombre':'','duracion':'','max_alumnos':''};
                    toastr.success('Curso creado con éxito', {timeOut: 5000});
                });
            }
        },
        clean: function(){

            this.newItem = {'nombre':'','duracion':'','max_alumnos':''};
        }
    }
}
</script>
