<template>
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="card">
				<div class="card-title">
					<div class="row line-head" >
						<br><h5 class="col-md-2 col-sm-2 col-xs-2"><i class="fa fa-book"></i><b>Curso :</b></h5>
						<div class="col-md-4 col-sm-4 col-xs-4">
							<select class="form-control" required="required" autofocus="autofocus" v-model="id" @change="getVueItems(id)">
								<option v-for="curso in cursos" :value='curso.id'>{{ curso.nombre }}</option>
							</select>
						</div>
					</div>
				</div>
				<div class="card-body">
					<div></div>
					<table class="table table-hover">
						<thead>
							<tr>
								<th>Codigo Matricula</th>
								<th>DNI</th>
								<th>Apellidos - Nombres</th>
								<th>Nota</th>
								<th>Hora Entrada</th>
								<th>Dias</th>
								<th>Curso</th>
								<th>Horas Duración</th>
							</tr>
						</thead>
						<tbody>
							<tr v-for="item in items">
								<td>{{ item.code }}</td>
								<td>{{ item.dni }}</td>
								<td>{{ item.apellidos }} {{ item.nombres }}</td>
								<td>{{ item.nota }}</td>
								<td>{{ item.hora_inicio }}</td>
								<td>{{ item.dia }}</td>
								<td>{{ item.nombre }}</td>
								<td>{{ item.duracion }}</td>
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
				id:'',
				items:[],
				cursos:[],
				formErrors:{},
				formErrorsUpdate:{},
			}
		},
		created(){
			this.getCursos();		
		},
		methods:{
			getCursos: function(){
				var that=this;
				axios.get('/cursos/combo').then(function(response){
					that.cursos=response.data;
				});
			},
			getVueItems: function(id){
				var that=this;
				axios.get('/notas/reporte/'+id).then(response=>{
					that.items=response.data;
				});
			}
		}
	}	
</script>