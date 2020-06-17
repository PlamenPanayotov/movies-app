<template>
  <div>
    <div>
      <h3 class="login-account">
        Login
        <small class="text-muted">Please sign in</small>
      </h3>
    </div>
    <form method="post" v-on:submit.prevent="login" class="form-group">
      <div class="form-group-row">
        <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
        <div class="col-sm-10">
          <input
            type="email"
            value
            name="email"
            id="inputEmail"
            class="form-control"
            v-model="email"
            placeholder="Email"
            reqired
            autofocus
          />
        </div>
      </div>
      <div class="form-group-row">
        <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
        <div class="col-sm-10">
          <input
            type="password"
            value
            name="password"
            id="inputPassword"
            class="form-control"
            v-model="password"
            placeholder="Password"
            reqired
          />
        </div>
      </div>

      <input type="hidden" name="_csrf_token" v-model="csrf_token" />

      <button class="btn btn-lg btn-primary" type="submit">Sign in</button>
    </form>
    <div v-if="isError === true">
      <div class="alert alert-danger" role="alert">{{ errorMessage }}</div>
    </div>
  </div>
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
      let email = this.emal
      let password = this.password
      this.$store.dispatch('login', { email, password })
      .then(() => this.$router.push('/'))
      .catch(err => console.log(err))
    }
  }
};
</script>