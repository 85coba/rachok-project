import Vue from 'vue';
import './plugins/vuetify';
import createFilters from './components/filter/filters';


import router from './router';
import store from './store';
import App from './App.vue';

createFilters(Vue);

Vue.config.productionTip = false

new Vue({
  router,
  store,
  render: h => h(App),
}).$mount('#app')
