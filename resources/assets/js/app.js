
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

//------------------------------------------------------
Vue.component('aulas',require('./components/Aulas.vue'));
Vue.component('cursos',require('./components/Cursos.vue'));
Vue.component('addcurso',require('./components/CursoCrear.vue'));
Vue.component('alumnos',require('./components/Alumnos.vue'));
Vue.component('addalumno',require('./components/AlumnoCrear.vue'));
Vue.component('horarios',require('./components/Horarios.vue'));
Vue.component('addhorario',require('./components/HorarioCrear.vue'));
Vue.component('temas',require('./components/Temas.vue'));
Vue.component('addtema',require('./components/TemaCrear.vue'));
Vue.component('addmatricula',require('./components/MatriculaCrear.vue'));
Vue.component('notas',require('./components/Notas.vue'));
Vue.component('addasistencia',require('./components/AsistenciaCrear.vue'));
Vue.component('addcertificado',require('./components/Certificados.vue'));
//-------------------------------------------------------
const app = new Vue({
    el: '#app'
});