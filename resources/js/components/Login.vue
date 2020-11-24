<template>
  <div>
    <div class="my-3">
      <h1 class="mt-2">Login</h1>
    </div>
    <form>
      <div class="form-group">
        <label>Email</label>
        <input v-model="email" class="form-control" type="text" name="email">
      </div>

      <div class="form-group">
        <label>Password</label>
        <input v-model="password" class="form-control" type="password" name="password">
      </div>
      <button type="button" @click="submitLogin">Login</button>
    </form>
  </div>
</template>

<script>
import {mapMutations} from "vuex";
import {submitLogin} from "../logic/login.js";

export default {
  data: function() {
    return {
      email: "",
      password: ""
    };
  },
  methods: {
    submitLogin() {
      submitLogin(this.email, this.password)
        .then((ev) => {
          this.$store.commit({
            type: "userHasLogged",
            data: ev.target.response.token
          });
          this.$router.push("/account");
        })
        .catch((err) => {
          console.log(err);
        });
    }
  }
};
</script>
