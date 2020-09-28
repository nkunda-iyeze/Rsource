require('./bootstrap');
import axios from 'axios'


window.Vue = require('vue');

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('article-blogs', require('./components/Articles.vue').default);
Vue.component('navbar-blog', require('./components/NavBar.vue').default);


const app = new Vue({

}).$mount('#app')
