require('./bootstrap');
import App from "./App.vue";
import Vue from "vue";
import VueRouter from "vue-router";
import Vuex from "vuex";
import routerSetup from "./router.js";
import storeSetup from "./store.js";

Vue.use(VueRouter);
Vue.use(Vuex);


new Vue({
  render: h => h(App),
  router: routerSetup(VueRouter),
  store: storeSetup(Vuex),
  beforeCreate: function() {

    // add hooks to router for filter authorization rules
    this.$router.beforeEach((to, from, next) => {
      if (this.$store.state.user.hasLogin) {
        if (to.meta.authExclude == true) {
          next("/");
        } else {
          next();
        }
      } else {
        if (to.meta.authGuard == true) {
          next("/login");
        } else {
          next();
        }
      }
    });

    // because hooks added after vue router object assigned to vue
    // it need to recheck the first loaded route and
    // apply authorization rules
    if (this.$router.currentRoute.meta.authGuard == true &&
      this.$store.state.user.hasLogin == false
    ) {
      this.$router.push("/login");
    }

  }
}).$mount("#app");
