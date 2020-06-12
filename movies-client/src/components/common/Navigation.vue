<template>
  <nav>
    <ul>
      <li>
        <router-link to="/" exact>Home</router-link>
      </li>
      <li>
        <router-link to="/login" exact>Login</router-link>
      </li>
      <li>
        <router-link to="/register" exact>Register</router-link>
      </li>
      <li>
        <router-link to="/profile" exact>Prolile</router-link>
      </li>
      <li>
        <a @click="onLogout" class="logout">Logout</a>
      </li>
    </ul>
  </nav>
</template>

<script>
import authAxios from "@/axios-auth";
export default {
  methods: {
    onLogout() {
      authAxios
        .post("logout")
        .then(() => {
          localStorage.removeItem("jwt");
          localStorage.removeItem("userId");
          this.$emit("onAuth", false);
        })
        .cath(err => {
          console.error(err);
        });
    }
  },
  name: "Navigation",
  beforeCreate() {
    this.$emit("onAuth", localStorage.getItem("jwt") !== null);
  }
};
</script>

<style>
</style>