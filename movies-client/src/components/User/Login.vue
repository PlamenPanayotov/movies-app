<template>
  <form @submit.prevent="login">
    <input v-model="email" placeholder="email" />
    <input v-model="password" placeholder="password" />
    <input type="submit" value="Login" />
  </form>
</template>

<script>
import authAxios from "@/axios-auth";
export default {
  name: "Login",
  data() {
    return {
      email: "",
      password: ""
    };
  },
  methods: {
    login() {
      const payload = {
        email: this.email,
        password: this.password
      };
      authAxios
        .post("login", payload)
        .then(response => {
          const localId = response.data.userId;
          const jwt = response.data.jwt;
          localStorage.setItem("userId", localId);
          localStorage.setItem("jwt", jwt);
          console.log(response);
        })
        .catch(err => {
          console.error(err);
        });
      this.$router.push("/");
    }
  }
};
</script>