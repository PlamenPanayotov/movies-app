<template>
  <form @submit.prevent="register">
    <input v-model="email" placeholder="email" />
    <input v-model="password" placeholder="password" />
    <input v-model="password_confirmation" placeholder="password_confirmation" />
    <input type="submit" value="Register" />
  </form>
</template>

<script>
export default {
  name: "Register",
  data() {
    return {
      email: "",
      password: "",
      password_confirmation: ""
    };
  },
  methods: {
    register() {
      const payload = {
        email: this.email,
        password: this.password,
        password_confirmation: this.password_confirmation
      };
      this.$store.dispatch("register", payload);
      this.$router.push("login");
    }
  }
};
</script>

<style scoped>
</style>