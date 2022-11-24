import Vue from 'vue'
import App from './App.vue'
import router from './Router'
import Vuelidate from 'vuelidate'
import store from './Store/store'
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
import { VueMailchimpEmailSignupForm } from "vue-mailchimp-email-signup-form";
import "vue-mailchimp-email-signup-form/dist/vue-mailchimp-email-signup-form.css";
Vue.component("vue-mailchimp-email-signup-form", VueMailchimpEmailSignupForm);
Vue.config.productionTip = false
Vue.use(Vuelidate);
Vue.use(VueSweetalert2);
new Vue({
  router,
  store,
  render: h => h(App),
}).$mount('#app')
