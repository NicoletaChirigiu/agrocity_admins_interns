<template>
  <div class="login">
    <div class="login__title">
      Welcome to login page
    </div>
    <form class="login__form">
      <input
        type="email"
        name="email"
        id="email"
        placeholder="email"
        required
        v-model="email"
      />
      <input
        type="password"
        name="password"
        id="password"
        placeholder="password"
        autocomplete="cc-csc"
        required
        v-model="password"
      />
    </form>
    <button type="submit" @click="login">Login</button>
    <router-view />
  </div>
</template>

<script>
// import { bus } from "../../main";
import Store from "../../store/store";
import Axios from "axios";
export default {
  name: "LoginPage",
  data() {
    return {
      email: null,
      password: null,
    };
  },
  methods: {
    login() {
      Axios.post("http://localhost:8888/login", {
        users_email: this.email,
        users_password: this.password,
      })
        .then((response) => {
          if (response.status === 200 && response.data.message) {
            this.$router.push('user');
            console.log(response);
            // bus.$emit("name", response.data.username);
             Store.getUserData(response.data);
          } else {
            console.log(response);
          }
        })
        .catch((e) => {
          console.log("err:", e.response);
        });
    },
  },
};
</script>

<style></style>
