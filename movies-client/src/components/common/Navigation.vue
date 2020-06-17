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
      <li v-if="isLoggedIn">
        <a @click="logout" class="logout">Logout</a>
      </li>
    </ul>
  </nav>
</template>

<script>
export default {
  computed: {
    isLoggedIn: function() {
      return this.$store.getters.isLoggedIn;
    }
  },
  methods: {
    logout: function() {
      this.$store.dispatch("logout").then(() => {
        this.$router.push("/login");
      });
    }
  }
};
</script>

<style>
</style>