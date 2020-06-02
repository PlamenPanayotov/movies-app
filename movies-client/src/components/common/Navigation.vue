<template>
  <nav>
    <ul>
      <li>
        <router-link to="/" exact>Home</router-link>
      </li>
      <li v-if="!isAuth">
        <router-link to="/login" exact>Login</router-link>
      </li>
      <li v-if="!isAuth">
        <router-link to="/register" exact>Register</router-link>
      </li>
      <li v-if="isAuth">
        <router-link to="/profile" exact>Prolile</router-link>
      </li>
      <li v-if="isAuth">
        <a @click="onLogout" class="logout">Logout</a>
      </li>
    </ul>
  </nav>
</template>

<script>
export default {
  props: {
    isAuth: Boolean
  },
  methods: {
    onLogout() {
      localStorage.removeItem("jwt");
      localStorage.removeItem("userId");
      this.$emit("onAuth", false);
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