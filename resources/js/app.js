require('./bootstrap');

window.Vue = require('vue');

import VueRouter from 'vue-router';
Vue.use(VueRouter);

import VueAxios from 'vue-axios';
import axios from 'axios';

import App from './App.vue';
Vue.use(VueAxios, axios);

import VuejsDialog from 'vuejs-dialog/';
import VuejsDialogMixin from "vuejs-dialog/dist/vuejs-dialog-mixin.min.js" // only needed in custom components
 
// include the default style
import 'vuejs-dialog/dist/vuejs-dialog.min.css'
Vue.use(VuejsDialog);

import HomeComponent from './components/HomeComponent.vue';
import CreateComponent from './components/CreateAndEditComponent.vue';

const routes = [
  {
      name: 'home',
      path: '/',
      component: HomeComponent
  },
  {
      name: 'create',
      path: '/create',
      component: CreateComponent
  },
];

const router = new VueRouter({ mode: 'history', routes: routes});
const app = new Vue(Vue.util.extend({ router }, App)).$mount('#app');