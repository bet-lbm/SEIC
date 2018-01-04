<template> 
<div class="row">
    <div class="col-md-10 col-sm-12 col-xs-12 col-md-offset-1">
        <div class="card">
            <h4 class="card-title line-head"><i class="fa fa-user-plus"></i> <b> Registrar Alumno Nuevo </b></h4>
            <form class="form-horizontal">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">DNI</label>
                                <div class="col-md-8">
                                    <input class="form-control" type="text" placeholder="Ingrese número de DNI" required="required" v-model="newItem.dni" autofocus>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Apellidos</label>
                                <div class="col-md-8">
                                    <input class="form-control" min="10" type="text" placeholder="Ingrese apellidos" required="required" v-model="newItem.apellidos">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Nombres</label>
                                <div class="col-md-8">
                                    <input class="form-control" type="text" placeholder="Ingrese nombres" required="required" v-model="newItem.nombres">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Género</label>

                                <div class="animated-radio-button col-md-4">
                                    <label>  
                                        <input class="form-control" type="radio" value="F" v-model="newItem.sexo">
                                            <span class="label-text">Femenino</span>
                                        </input>
                                    </label>
                                </div>
                                <div class="animated-radio-button col-md-4">
                                    <label>
                                        <input class="form-control" type="radio" value="M" v-model="newItem.sexo">
                                            <span class="label-text">Masculino</span>
                                        </input>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Dirección</label>
                                <div class="col-md-8">
                                    <input class="form-control" type="text" placeholder="Ingrese dirección" required="required" v-model="newItem.direccion">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Teléfono</label>
                                <div class="col-md-8">
                                    <input class="form-control" type="phone" placeholder="número de teléfono o celular" required="required" v-model="newItem.telefono">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">e-mail</label>
                                <div class="col-md-8">
                                    <input class="form-control" type="email" placeholder="hola@ejemplo.com" required="required" v-model="newItem.email">
                                </div>
                            </div>
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
            newItem : {'dni':'','nombres':'','apellidos':'','sexo':'','direccion':'','email':'','telefono':''},
            formErrors: {},
            formErrorsUpdate: {},
        }
    },
    methods : {

        createItem: function(){
            var input = this.newItem;
            if((input['nombres'] == '')||(input['dni'] == '')||(input['apellidos'] == '')||(input['direccion'] == '')||(input['telefono']=='')){
                toastr.warning('Complete todos los campos', {timeOut: 5000});
            }
            else{
                axios.post('/alumnos',input)
                .then(response => {
                    this.newItem = {'dni':'','nombres':'','apellidos':'','sexo':'','direccion':'','email':'','telefono':''};
                    toastr.success('Nuevo alumno registrado con éxito', {timeOut: 5000});
                });
            }
        },
        clean: function(){

            this.newItem = {'dni':'','nombres':'','apellidos':'','sexo':'','direccion':'','email':'','telefono':''};
        }
    }
}
</script>
