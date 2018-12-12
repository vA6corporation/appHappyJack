
require('./bootstrap');

window.Vue = require('vue');
import VueRouter from 'vue-router';
import Vue from 'vue';
import VueResource from 'vue-resource';
import {routes} from './routes';
import store from './store';
import ToggleButton from 'vue-js-toggle-button'

import Snotify from 'vue-snotify'; // 1. Import Snotify
// 2. Use Snotify
// You can pass {config, options} as second argument. See the next example or setConfig in [API] section 
Vue.use(Snotify, {
  toast: {
    timeout: 5000
  }});

Vue.use(ToggleButton)
Vue.use(VueResource);
Vue.use(VueRouter);

var baseUrl = '/appHappyJack/';
// var baseUrl = '/';

Vue.component('message', require('./components/message.vue'));

Vue.http.options.root = baseUrl;
Vue.http.headers.common['X-CSRF-TOKEN'] = $('meta[name="csrf-token"]').attr('content');

const router = new VueRouter({
  base: baseUrl,
  routes,
  mode: 'history',
});

Vue.mixin({
  computed: {
    date() {
      var date = new Date();
      var day = date.getDate();
      var month = date.getMonth()+1;
      var year = date.getFullYear();

      if (month.toString().length < 2) {month = '0' + month};
      if (day.toString().length < 2) {day = `0${day}`};
      return `${year}-${month}-${day}`;
      // return [year, month, day].join('-');
    }
  }
})

const app = new Vue({
  store,
  router,
  el: '#app',
  updated: function() {
    this.$nextTick(function () {
      feather.replace();
    });
  },
});

feather.replace()
