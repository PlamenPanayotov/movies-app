<template>
  <form @submit.prevent="login">
    <input v-model="email" placeholder="email" />
    <input v-model="password" placeholder="password" />
    <input type="submit" value="Login" />
  </form>
</template>

<script>
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
      fetch("https://localhost:8000/login", {
        method: "post",
        headers: { "Content-type": "application/json" },
        body: JSON.stringify(payload)
      })
        .then(payload => console.log(payload))
        .catch(e => {
          console.log(e);
        });
      this.$router.push("profile");
    }
  }
};
</script>